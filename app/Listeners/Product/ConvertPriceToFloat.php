<?php

namespace App\Listeners\Product;

use App\Events\Product\GetProductEvent;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Ramsey\Collection\Collection;

class ConvertPriceToFloat
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
    public function handle(GetProductEvent $event): void
    {
        if ($event->product instanceof Collection) {
            $event->product->transform(function($product) {
                $product->price /= 100;
                return $product;
            });
        } elseif ($event->product instanceof Product) {
            $event->product->price /= 100;
        }
    }
}
