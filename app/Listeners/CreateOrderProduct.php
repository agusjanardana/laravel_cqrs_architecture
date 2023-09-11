<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Kafka\Producer;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

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
        $data = $event->dataProduct;

        // add to order history table with kafka query
        $this->kafka->CreateOrder($data);

        // add to table order
        $saveData = DB::table('orders')->insert([
            'product_id' => $data->product_id,
            'username' => "contoh_user",
            'quantity' => $data->quantity,
            'total_price' => $data->total_price,
        ]);

        // update stock quantity table Product
        $dataProduct = Product::where('id', $data->product_id)->first();
        $dataProduct->quantity -= $data->quantity;
        $dataProduct->save();
    }
}
