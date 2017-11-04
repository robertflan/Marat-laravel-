<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'is_popular' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopePopular($query)
    {
        return $query->where('is_popular', 1);
    }

    public function scopeOfCompany($query, $company = 1)
    {
        return $query->where('company_id', $company);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

	public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'category_jobs');
    }
}
