<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Food extends Model
{
    use HasFactory;

    protected $quarded = [];

    protected $table = 'foods';

    protected $fillable = [
        'name',
        'slug',
        'price',
        'image',
    ];

    // public function category(): BelongsTo
    // {
    //     return $this->belongsTo(Category::class, 'category_id', 'id');
    // }
}
