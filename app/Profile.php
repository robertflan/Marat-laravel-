<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'self_destroy' => 'boolean',
        'qualifications' => 'array',
        'qualification_files' => 'array',
        'languages' => 'array',
        'language_levels' => 'array',
        'other_documents' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    // public function scopePopular($query)
    // {
    //     return $query->where('is_popular', 1);
    // }

    // public function scopeOfCompany($query, $company = 1)
    // {
    //     return $query->where('company_id', $company);
    // }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = \Carbon\Carbon::createFromFormat('d.m.Y', $value);
    }

    public function age()
    {
        return \Carbon\Carbon::parse($this->attributes['dob'])->age;
    }

    public function getDobAttribute($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d.m.Y');
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

	public function user()
    {
        return $this->belongsTo(User::class);
    }
}
