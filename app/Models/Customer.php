<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    /**
     * Get the sales for the customer.
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Get the quotations for the customer.
     */
    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    /**
     * Get the accounts receivable for the customer.
     */
    public function accountsReceivable()
    {
        return $this->hasMany(AccountsReceivable::class);
    }
}
