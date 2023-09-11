<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class CreateProduct
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //create product


        $data = $event->dataProduct;

        DB::connection('command')->table('products')->insert([
            'product_name' => $data['product_name'],
            'price' => $data['price'],
            'stock' => $data['stock'],
        ]);
    }
}