<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
	protected $table = 'jobs';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
		protected $casts = [
        'active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeOfCompany($query, $company = 1)
    {
        return $query->where('company_id', $company);
    }

		public function scopeIsActive($query, $active)
    {
        return $query->where('active', $active);
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

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_jobs');
    }

    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_jobs');
    }

    // public function locations()
    // {
    //     return $this->belongsToMany(Location::class, 'location_jobs');
    // }

    public function getCreatedAtAttribute($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y');
    }
}
