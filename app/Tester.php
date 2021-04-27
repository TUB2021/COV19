<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tester extends Model
{
    protected $fillable = [
        'user_id', 'test_center_id'
    ];
}
