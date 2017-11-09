<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    //
    use SoftDeletes;
    
        protected $table = 'documents';
        protected $primaryKey = 'id';
        // public $timestamps = false;
        protected $guarded = ['id'];
        // protected $fillable = [];
        // protected $hidden = [];
        protected $dates = ['deleted_at'];
        public function category()
        {
            return $this->belongsTo(Category::class);
        }
        public function documentgroup()
        {
            return $this->belongsTo(DocumentGroup::class);
        }
        public function document_type()
        {
            return $this->belongsTo(DocumentType::class);
        }
        public function application()
        {
            return $this->belongsTo(Application::class);
        }
        
}
