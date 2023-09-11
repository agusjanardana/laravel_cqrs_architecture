<?php

namespace App\Kafka;


use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;



class Producer {

    public function CreateOrder($data){

        try{

            // publishOn
            $producer = Kafka::publishOn('order_history')
                ->withBodyKey('data', $data)
                ->withKafkaKey($data['order_id'])
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Content-Length' => strlen(json_encode($data))
                ]);

            $producer->send();

            return "success publish kafka";
        } catch(\Exception $e){
            dd($e);
            return "error publish kafka";
        }

    }
}


?>