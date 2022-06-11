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
