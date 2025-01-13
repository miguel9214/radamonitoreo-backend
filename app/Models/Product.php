<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'purchase_price',
        'profit_margin',
        'sale_price',
        'vat',
        'total_sale_price',
        'image',
        'stock',
    ];

    /**
     * Get the inventory records associated with the product.
     */
    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    /**
     * Get the sales records associated with the product.
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Get the best selling records associated with the product.
     */
    public function bestSellings()
    {
        return $this->hasMany(BestSelling::class);
    }

    /**
     * Get the least selling records associated with the product.
     */
    public function leastSellings()
    {
        return $this->hasMany(LeastSelling::class);
    }
}
