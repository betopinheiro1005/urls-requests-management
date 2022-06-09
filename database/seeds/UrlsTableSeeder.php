<?php

use Illuminate\Database\Seeder;
use \App\Url;

class UrlsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Url::create([
            'id' => 1,
            'url' => 'https://economia.awesomeapi.com.br/last/USD-BRL',
            'description' => 'Cotação do Dólar Americano em Real Brasileiro.',
            'response'  => '{
                "USDBRL": {
                  "code": "USD",
                  "codein": "BRL",
                  "name": "Dólar Americano/Real Brasileiro",
                  "high": "4.7347",
                  "low": "4.7319",
                  "varBid": "0.0004",
                  "pctChange": "0.01",
                  "bid": "4.7314",
                  "ask": "4.7324",
                  "timestamp": "1654072321",
                  "create_date": "2022-06-01 05:32:01"
                }
              }',
            'status_code' => '200',
            'consultation_date' => '2022-06-01 05:32:01',
            'created_at' => '2022-06-01 03:28:10',
            'updated_at' => '2022-06-01 03:28:10'
        ]);        

        Url::create([
          'id' => 2,
          'url' => 'https://viacep.com.br/ws/01001000/json/',
          'description' => 'Consulta CEP 01001-000',
          'response'  => '{
            "cep": "01001-000",
            "logradouro": "Praça da Sé",
            "complemento": "lado ímpar",
            "bairro": "Sé",
            "localidade": "São Paulo",
            "uf": "SP",
            "ibge": "3550308",
            "gia": "1004",
            "ddd": "11",
            "siafi": "7107"
          }',
          'status_code' => '200',
          'consultation_date' => '2022-06-04 10:45:28',
          'created_at' => '2022-06-02 14:10:29',
          'updated_at' => '2022-06-02 14:10:29'
      ]);        

    }

}
