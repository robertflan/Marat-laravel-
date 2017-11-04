<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question_title', 'type', 'options'];
    
    protected $casts = [
        'options' => 'json'
    ];

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

}
