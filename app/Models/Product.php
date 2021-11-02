<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    // 'title' => '',
    // 'content' => '',
    // 'photo' => '',
    // 'department_id' => '',
    // 'trademark_id' => '',
    // 'manufacturer_id' => '',
    // 'color_id' => '',
    // 'size_id' => '',
    // 'currency_id' => '',
    // 'price' => '',
    // 'stock' => '',
    // 'start_at' => '',
    // 'end_at' => '',
    // 'start_offer_at' => '',
    // 'end_offer_at' => '',
    // 'offer_price' => '',
    // 'other_data' => '',
    // 'weight' => '',
    // 'weight_id' => '',
    // 'status' => '',
    // 'reason' => '',
    use HasFactory, HasTranslations;
    public $translatable = ['title', 'content'];
    protected $guarded = [];
    protected $casts = ['mall_id' => 'array', 'other_data' => 'array'];

    public function files()
    {
        return $this->hasMany(File::class, 'relation_id', 'id')->where('file_for', 'product');
    }
}
