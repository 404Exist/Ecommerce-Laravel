<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['name', 'currency'];
    protected $guarded = [];

    public function malls()
    {
        return $this->hasMany(Mall::class);
    }
}
