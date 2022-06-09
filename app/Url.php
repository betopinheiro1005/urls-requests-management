<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $table = 'urls';

    protected $fillable = [
        "url", "response","description", "status_code", "consultation_date"
    ];

}