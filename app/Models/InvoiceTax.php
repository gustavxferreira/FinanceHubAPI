<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceTax extends Model
{
    use HasFactory;

    protected $table = 'invoice_tax';
    
    protected $fillable = [
        'incomes_id',
        'IRFF_percentage',
        'IRFF_amount',
        'CSLL_percentage',
        'CSLL_amount',
        'COFINS_percentage',
        'COFINS_amount',
        'PIS_percentage',
        'PIS_amount',
        'tribute_percentage',
        'tribute_amount',
        'withheld',
        'money_before_withholding',
    ];
}
