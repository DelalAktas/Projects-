<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Blog extends Model
{
    public $primaryKey = 'id';
    protected $table = 'blogs';
    protected $fillable = [
        'title', 'description',
    ];
    public $timestamps=true;
    public function user(){
        return $this->belongsTo('App\User');
    }
}
