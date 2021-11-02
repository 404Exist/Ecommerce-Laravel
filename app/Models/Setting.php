<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['sitename', 'message_maintenance'];
    protected $guarded = [];
}
