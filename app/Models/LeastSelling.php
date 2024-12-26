<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeastSelling extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'quantity_sold',
    ];

    /**
     * Get the product that is least selling.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}