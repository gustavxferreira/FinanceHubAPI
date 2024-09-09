<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incomes extends Model
{
    use HasFactory;

    protected $table = 'incomes';

    protected $fillable = 
    [
        'incomes_name', 
        'amount',
        'tax_amount',
        'due_date',
        'issue_date',
        'date_received',
        'obs',
    ];
}
