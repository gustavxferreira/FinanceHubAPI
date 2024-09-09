<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model

{
    use HasFactory;

    protected $table = 'categories';
    public $timestamps = false;
    protected $fillable = [
        'category_name',
        'category_description',
    ];

    public function expenses()
    {
        return $this->hasMany(Expenses::class, 'category_id', 'id');
    }
}
