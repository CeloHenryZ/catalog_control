<?php

namespace App\Models;

use App\Events\Product\GetProductEvent;
use App\Events\Product\SaveProductEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        "title",
        "description",
        "owner_id",
        "price",
        "category_id"
    ];

    protected $dispatchesEvents = [
        "creating" => SaveProductEvent::class,
        "updating" => SaveProductEvent::class,
        "retrieved" => GetProductEvent::class
    ];
}
