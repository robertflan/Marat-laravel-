<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $table = 'companies';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    // protected $casts = [];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
