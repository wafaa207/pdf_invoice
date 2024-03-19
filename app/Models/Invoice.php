<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'company_id',
        'user_id',
        'date_issued',
        'due_date',
        'deposit_requested',
        'deposit_due',
        'subtotal',
        'discount',
        'tax',
        'total'
    ];


    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items(){
        return $this->hasMany(InvoiceItems::class, 'invoice_id', 'id');
    }
}
