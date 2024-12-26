<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountsPayable extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'supplier_id',
        'amount',
        'due_date',
        'status',
    ];

    /**
     * Get the supplier that owns the account payable.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
