<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Department extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['name'];
    protected $guarded = [];

    public function parents()
    {
        return $this->hasMany(Department::class, 'id', 'parent_id');
    }
}

