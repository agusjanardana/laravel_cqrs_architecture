<?php

namespace App\Kafka;


use Junges\Kafka\Facades\Kafka;


class Producer {

    public function CreateOrder($data){

        $producer = Kafka::publishOn( 'topic', 'broker',)
            ->withConfigOptions(['key' => 'value'])
            ->withKafkaKey('your-kafka-key')
            ->withKafkaKey('kafka-key')
            ->withHeaders(['header-key' => 'header-value']);

        $producer->send();

    }
}


?>