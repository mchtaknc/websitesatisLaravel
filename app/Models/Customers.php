<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customers extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
        'firstname',
        'lastname',
        'phonenumber',
        'company_name',
        'address',
        'country',
        'city',
        'state',
        'tax_id',
        'tax_office'
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'customer_id', 'id');
    }
}
