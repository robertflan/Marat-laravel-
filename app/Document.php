<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $table = 'documents';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    protected $dates = ['deleted_at'];
    // protected $casts = [];
    protected $appends = ['document_group'];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

	public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
    public function document_group()
    {
        return $this->belongsTo(DocumentGroup::class);
    }


    public function document_type()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function updated_by_user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function size_human($precision = 2) {
        $base = log($this->attributes['size'], 1024);
        $suffixes = array('', 'Kb', 'Mb', 'Gb', 'Tb');

        return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    public function getDocumentGroupAttribute()
    {
        if(isset($this->relations['document_type']) && isset($this->relations['document_type']->relations['document_group'])) {
            return $this->relations['document_type']->relations['document_group']->id;
        } else {
            return 0;
        }
    }

    public function getTabAttribute()
    {
        if(isset($this->relations['document_type']) && isset($this->relations['document_type']->relations['document_group'])) {
            return $this->relations['document_type']->relations['document_group']->tab_name;
        } else {
            return 0;
        }
    }
}
