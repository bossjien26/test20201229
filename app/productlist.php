<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productlist extends Model
{
    protected $fillable = ['id','product', 'oprice', 'sprice', 'Vendor', 'image','produce','add_time'];
}
