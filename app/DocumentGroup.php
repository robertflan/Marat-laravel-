<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentGroup extends Model
{
	use SoftDeletes;

    protected $table = 'document_groups';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    protected $dates = ['deleted_at'];
    // protected $casts = [];

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

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

    public function document_types()
    {
        return $this->hasMany(DocumentType::class);
    }

		public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
