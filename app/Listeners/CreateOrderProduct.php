<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Kafka\Producer;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Throwable;

class CreateOrderProduct
{

    public $kafka;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        $this->kafka = new Producer;
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //
        $data = $event->dataProductRequest;
        // transaction
        try{
            DB::connection('command')->beginTransaction();

            // update stock quantity table Product
            $dataProduct = Product::where('id', $data['product_id'])->first();

            // add to table order
            $orderData = DB::connection('command')->table('orders')->insertGetId([
                'product_id' => $data['product_id'],
                'username' => "contoh_user",
                'quantity' => $data['quantity'],
                'total_price' => $data['quantity'] * $dataProduct->price,
            ]);


            $dataProduct->stock -= $data['quantity'];
            $dataProduct->save();

            // add to order history table with kafka query
            $dataToKafkaOrderHistory = [
                'product_id' => $data['product_id'],
                'order_id' => $orderData,
                'username' => "contoh_user",
            ];

            $kafkaPublish = $this->kafka->CreateOrder($dataToKafkaOrderHistory);
            if ($kafkaPublish == "error publish kafka") {
                DB::connection('command')->rollback();
                return;
            }

            DB::connection('command')->commit();

        } catch(\Exception $e){
            dd($e);
            DB::connection('command')->rollback();
            return;
        }

    }
}
