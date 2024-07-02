<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class book extends Model
{
    use HasFactory,SoftDeletes,Searchable;
    protected $fillable = [
        'title',
        'description',
        'price',
        'category',
        'image'
    ];
    protected $dates = ['deleted_at'];
    public function likes()
    {
        return $this->hasMany(Like::class, 'book_id');
    }
   
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
        ];
    }
}
