<?php

namespace App\Listeners\Product;

use App\Events\Product\SaveProductEvent;

class ConvertPriceToInt
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
    public function handle(SaveProductEvent $event): void
    {
        $event->product->price *= 100;
    }
}
