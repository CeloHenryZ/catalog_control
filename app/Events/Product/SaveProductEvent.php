<?php

namespace App\Events\Product;

use App\Models\Product;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SaveProductEvent
{
    use Dispatchable;

    public Product $product;
    /**
     * Create a new event instance.
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}
