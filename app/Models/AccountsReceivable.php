<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountsReceivable extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'amount',
        'due_date',
        'status',
    ];

    /**
     * Get the customer that owns the account receivable.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
