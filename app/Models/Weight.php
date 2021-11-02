<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Weight extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['name'];
    protected $guarded = [];
}
