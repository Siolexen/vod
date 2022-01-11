<?php

namespace App\Repositories;

use Protechstudio\PrestashopWebService\PrestashopWebService;

class PrestashopRepositories
{

    /**
     * @var PrestaShopWebservice
     */

    protected PrestaShopWebservice $prestashop;

    /**
     * PrestashopRepository constructor.
     */

    public function __construct(array $auth = [])
    {
        $this->prestashop = new PrestaShopWebservice(
            config('prestashop-webservice.url'),
            config('prestashop-webservice.token'),
//            config('prestashop-webservice.debug'));
            false);
    }

    public function getImageProduct(){

        $urlImage = config('prestashop-webservice.url').'/api/images/products/20/';
        $key  = config('prestashop-webservice.token');


        $xml = $this->prestashop->get([
            'resource' => 'images/products/20/Okladka',
//            'filter[id_customer]' => auth()->user()->id_customer,
        ]);
//        $imageTypes = $xml->image_types->children();
//        $images = $xml->images->children();
//        dd($xml,$images,$imageTypes);

//        $curl = curl_init();
//
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => 'http://presta.web/api/images/products/20/',
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => '',
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => 'GET',
//            CURLOPT_HTTPHEADER => array(
//                'Authorization: Basic UTM1QzJVTFQxUkRNTDdTRzJRSUFZUUpMQVVJMjhNWUw6'
//            ),
//        ));
//
//        $response = curl_exec($curl);
//
//        curl_close($curl);


        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
//        foreach ($array['orders']['order'] as $arr){
//            if(isset($arr['@attributes'])) {
//                $array_ids[] = $arr['@attributes']['id'];
//            } else {
//                $array_ids[] = $arr['id'];
//            }
//        }
//        dd($array);
    }

    public function getUserOrders(){

        $xml = $this->prestashop->get([
            'resource' => 'orders',
            'filter[id_customer]' => auth()->user()->id_customer,
        ]);

        $json = json_encode($xml);
        $array = json_decode($json,TRUE);

        $array_ids = [];
        try {
            foreach ($array['orders']['order'] as $arr){
                if(isset($arr['@attributes'])) {
                    $array_ids[] = $arr['@attributes']['id'];
                } else {
                    $array_ids[] = $arr['id'];
                }
            }
        } catch (\Exception $e) {

        }


        return $array_ids;
    }

    public function getUserOrderId(array $ids){
        $orders = [];
        foreach ($ids as $id){
            $xml = $this->prestashop->get([
                'resource' => 'orders',
                'id' => $id
            ]);

            $json = json_encode($xml);
            $array = json_decode($json,TRUE);
            $orders[] = $array['order'];
        }


        return $orders;
    }

    protected function convertData(ResponseInterface $response) : array
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}
