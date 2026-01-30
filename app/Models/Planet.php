<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Planet extends Model
{
    protected $fillable = [
        'name',
        'color',
        'description',
        'hero_id',
        'power_id'];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

}
