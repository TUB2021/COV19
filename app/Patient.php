<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'user_id', 'tester_id', 'patient_type', 'symptomps', 'status'
    ];
}
