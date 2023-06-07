<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'preference_id',
        'category_id',
        'title',
        'author',
        'description',
        'url',
        'urlToImage',
        'publishedAt'
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function preference()
    {
        return $this->belongsTo(Preference::class, 'preference_id');
    }

//    public function preference(): \Illuminate\Database\Eloquent\Relations\HasOne
//    {
//        return $this->hasOne(Preference::class, 'id', 'order_id');
//    }
}
