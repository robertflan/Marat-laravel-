<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'applications';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    // protected $casts = [
    //     'is_popular' => 'boolean',
    // ];

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

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

	public function applicant()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function updated_by_user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getStatusAttribute($status)
    {
        if($status == 0) {
            return 'Eingang';
        } elseif($status == 1) {
            return 'Gesprach';
        } elseif($status == 2) {
            return 'Einarbeitung';
        } elseif($status == 3) {
            return 'Zusage';
        } elseif($status == 4) {
            return 'Absage';
        } elseif($status == 5) {
            return 'Weidervorlage';
        } else {
            return $status;
        }
    }

    public function setStatusAttribute($status)
    {
        if($status == 'Eingang') {
            $this->attributes['status'] = 0;
        } elseif($status == 'Gesprach') {
            $this->attributes['status'] = 1;
        } elseif($status == 'Einarbeitung') {
            $this->attributes['status'] = 2;
        } elseif($status == 'Zusage') {
            $this->attributes['status'] = 3;
        } elseif($status == 'Absage') {
            $this->attributes['status'] = 4;
        } elseif($status == 'Weidervorlage') {
            $this->attributes['status'] = 5;
        } else {
            $this->attributes['status'] = $status;
        }
    }

    public function setContactAtAttribute($value)
    {
        $this->attributes['contact_at'] = \Carbon\Carbon::createFromFormat('d.m.Y H:i', $value);
    }

    public function getContactAtAttribute($date)
    {
        if($date) {
          return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y H:i');
        }

        return $date;
    }

    public function setInterviewAtAttribute($value)
    {
        $this->attributes['interview_at'] = \Carbon\Carbon::createFromFormat('d.m.Y H:i', $value);
    }

    public function getInterviewAtAttribute($date)
    {
        if($date) {
          return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y H:i');
        }

        return $date;
    }

    public function getShortStatusAttribute()
    {
        if($this->attributes['status'] == 0) {
            return 'EG';
        } elseif($this->attributes['status'] == 1) {
            return 'GE';
        } elseif($this->attributes['status'] == 2) {
            return 'EA';
        } elseif($this->attributes['status'] == 3) {
            return 'ZU';
        } elseif($this->attributes['status'] == 4) {
            return 'AB';
        } elseif($this->attributes['status'] == 5) {
            return 'WV';
        } else {
            return $this->attributes['status'];
        }
    }

    public function getCreatedAtAttribute($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y H:i');
    }

    public function getUpdatedAtAttribute($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y H:i');
    }
}
