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

        if(curl_error($ch)){

                $info = [
                    "status_code" =>  '400',
                    "response" => null
                ];

        } else {

            if($response === false){
                dd("response: " . $response . " - Solicite ao seu serviço de hospedagem habilitar o SSH");
            }

            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            // dd($httpcode);

            $decoded = json_decode($response, true);  // converte json em array
            // dd($httpcode, $decoded);

            if ($httpcode == "200" && is_array($decoded)) {

                $info = [
                    "status_code" =>  '200',
                    "response" => $response
                ];

            
            } else {
    
                if($httpcode == "200" && $decoded == null){

                        $info = [
                            "status_code" =>  '406',
                            "response" => null
                        ];

                } else {

                        $info = [
                            "status_code" =>  $httpcode,
                            "response" => null
                        ];
        
                }

            }
  
        }

        curl_close($ch);

        return $info;

    }

}
