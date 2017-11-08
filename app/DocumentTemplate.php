<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentTemplate extends Model
{
	use SoftDeletes;
    //

    protected $table = 'document_templates';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    protected $dates = ['deleted_at'];
    protected $casts = [
        'required' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function document_group()
    {
        return $this->belongsTo(DocumentGroup::class);
    }
    public function document_type()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function document()
    {
        return $this->HasMany(Document::class);
    }
}
