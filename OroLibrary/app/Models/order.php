<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class order extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'username',
        'user_address',
        'phone',
        'total',
    ];
    protected $dates = ['deleted_at'];
    public function books()
    {
        return $this->hasMany(order_item::class, 'order_id');
    }
}
