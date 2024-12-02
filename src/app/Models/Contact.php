<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'last_name','first_name','gender','email','tel1','tel2','tel3','address','category_id','detail'
    ];
}
