<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'street_address',
        'city',
        'state',
        'postal_code',
        'country',
        'phone'
    ];

    public function invoices(){
        return $this->hasMany(Invoice::class, 'company_id', 'id');
    }


}
