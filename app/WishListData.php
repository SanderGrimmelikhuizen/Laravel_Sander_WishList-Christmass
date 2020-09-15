<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishListData extends Model
{
    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
        'link',
    ];
}
