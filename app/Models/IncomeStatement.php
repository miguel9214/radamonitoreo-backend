<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeStatement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'total_income',
        'total_expense',
        'net_income',
    ];

    /**
     * Get the sales associated with the income statement.
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Get the expenses associated with the income statement.
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
