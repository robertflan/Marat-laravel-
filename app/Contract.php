<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    //
    protected $table = 'contracts';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['art', 'title', 'begin', 'end', 'updated_at'];
    // protected $hidden = [];
    // protected $dates = [];
    // protected $casts = [];

   
}
