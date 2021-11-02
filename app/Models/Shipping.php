<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Shipping extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['name'];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
