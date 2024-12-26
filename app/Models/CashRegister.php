<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashRegister extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'initial_amount',
        'final_amount',
    ];

    /**
     * Get the sales associated with the cash register.
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Get the expenses associated with the cash register.
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
