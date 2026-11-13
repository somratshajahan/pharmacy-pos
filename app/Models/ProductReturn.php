<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReturn extends Model
{
    protected $fillable = [
        'type',
        'medicine_id',
        'medicine_name',
        'quantity',
        'customer_id',
        'customer_name',
        'company_name',
        'returned_at',
    ];

    protected $casts = [
        'returned_at' => 'date',
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
