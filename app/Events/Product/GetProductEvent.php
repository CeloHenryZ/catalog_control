<?php

namespace App\Events\Product;

use App\Models\Product;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class GetProductEvent
{
    use Dispatchable;

    public $product;

    /**
     * Create a new event instance.
     */
    public function __construct($product)
    {
        $this->product = $product;
    }

}
