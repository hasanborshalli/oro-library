<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_item extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_id',
        'order_id',
        'quantity',
    ];
    public function book()
    {
        return $this->belongsTo(book::class, 'book_id');
    }
}
