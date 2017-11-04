<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['json', 'questionnaire_id', 'user_id'];
    protected $casts = [
    	'json' => 'json'
    ];
}
