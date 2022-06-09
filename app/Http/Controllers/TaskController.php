<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UrlRequest;
use App\Url;

class TaskController extends Controller
{

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

    public function update_request($id){
        $consultation_date = date('Y-m-d H:i:s');

        $url = Url::findOrFail($id);

        // dd($url);

        $result = $this->check_response($url->url);
        $url->status_code = $result['status_code'];
        $url->response = $result['response'];
        $url->consultation_date = $consultation_date;

        $url->update();

        return redirect('/urls')->with('message', 'URL atualizada com sucesso!');        
    }

    public function update_requests(){
        $data = Url::all();
        $num_urls = count($data);

        if($num_urls != 0){

            $consultation_date = date('Y-m-d H:i:s');

            for($i=1; $i <= $num_urls; $i++){
                
                if(!Url::find($i)){
                    $i++;
                    continue;
                } else {

                    $url = Url::findOrFail($i);            
                    
                    $result = $this->check_response($url->url);
                    $url->status_code = $result['status_code'];
                    $url->response = $result['response'];
                    $url->consultation_date = $consultation_date;
    
                    $url->update();

                }

            }

            return redirect('/urls')->with('message', 'URL\'s atualizadas com sucesso!');        

        } else {

            return redirect('/urls')->with('message', 'Não há URL para atualizar!');        
        }
    }
    

}
