<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;

    protected $table = 'expenses';
    protected $fillable =
    [
        'fixed_payment_id',
        'expense_name',
        'fixed_payment',
        'due_date',
        'date_payed',
        'obs',
        'repeat',
        'amount',
        'category_id',
        'times_installments',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }
}
