<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Query\Expression;
use App\Http\Requests\UrlRequest;
use App\Url;
use App\User;

class UrlController extends Controller
{
    public function index()
    {

        $urls = Url::orderBy('id','desc')->paginate(10);
        $total_urls = $urls -> count();

        // $result = json_encode($urls, true);
        // print_r($result);

        return view('urls.index', ['urls' => $urls, 'total_urls' => $total_urls]); 
    }

    public function create()
    {
        return view('urls.create');
    }

    public function store(UrlRequest $request)
    {
        $url = new Url();

        $url->url = $request->url;
        $url->description = $request->description;
        $url->consultation_date = date('Y-m-d H:i:s');

        $result = $this->check_response($url->url);
        $url->status_code = $result['status_code'];
        $url->response = $result['response'];

        $url->save();

        return redirect('/urls')->with('message','URL criada com sucesso!');
    }

    public function show($id)
    {
        $busca = Url::findOrFail($id);
        return view('urls.show', ['busca' => $busca]); 
    }

    public function edit($id)
    {
        $url = Url::findOrFail($id);
        return view('urls.edit', ['id' => $id, 'url' => $url]);
    }

    public function update(Request $request, $id)
    {
        $url = Url::findOrFail($id);

        $url -> url = $request -> url;
        $url -> description = $request -> description;

        $url -> update();

        return redirect('/urls')->with('message', 'Descrição da URL alterada com sucesso!');
    }

    public function destroy($id)
    {
        $url = Url::findOrFail($id);
        $url -> delete();
        return redirect('/urls')->with('message', 'URL excluída com sucesso!');
    }

    public function check_response($url){

        // dd($url);
        
        // Verifica response

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);

        // dd($response);

        if(curl_error($ch)){

                $info = [
                    "status_code" =>  '400',
                    "response" => null
                ];

        } else {

            $decoded = json_decode($response, true);  // converte json em array

            //testa se houve erro no parsing! Vai acusar erro de string mal-formada (JSON_ERROR_SYNTAX)
            if (json_last_error() == 0 || is_array($decoded)) {

                $info = [
                    "status_code" =>  '200',
                    "response" => $response
                ];

            
            } else {

                $tipo = substr_count(strtolower($response),"html");
                $tipo2 = substr_count(strtolower($response),"code : 301");
                $tipo3 = substr_count(strtolower($response),"code: 301");
                $tipo4 = substr_count(strtolower($response),"301 moved");
                $tipo5 = substr_count(strtolower($response),"error 404");
                $tipo6 = substr_count(strtolower($response),"not found");

                // dd($tipo2);
    
                if($tipo > 0){

                    if($tipo2 > 0 || $tipo3 > 0 || $tipo4 > 0){

                        $info = [
                            "status_code" =>  '301',
                            "response" => null
                        ];


                    } else if($tipo5 > 0 || $tipo6 > 0 || $decoded == null) {

                        $info = [
                            "status_code" =>  '404',
                            "response" => null
                        ];
        
                    }                         

                } else {    

                        $info = [
                            "status_code" =>  '406',
                            "response" => null
                        ];
   
                }

            }
  
        }

        curl_close($ch);

        return $info;

    }

}
