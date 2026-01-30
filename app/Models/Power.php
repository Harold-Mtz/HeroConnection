<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Power extends Model
{
    use softDeletes;
    public $timestamps = true;

    protected $fillable = [
        'hero_id',
        'name',
        'level',

    ];

    public static function find($id)
    {
    }

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

}
