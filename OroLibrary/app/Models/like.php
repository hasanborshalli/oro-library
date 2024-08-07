<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    use HasFactory;
    protected $fillable=['book_id'];
    public function book()
    {
        return $this->belongsTo(book::class, 'book_id');
    }
}