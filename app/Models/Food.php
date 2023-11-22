<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'name',
        'price',
        'category_id',
        'image',
        'ingredients',
        'deleted'

    ];

    protected static function booted()
    {
        static::creating(function ($food) {
            $food->ingredients = strtolower($food->ingredients);
        });

        static::updating(function ($food) {
            $food->ingredients = strtolower($food->ingredients);
        });
    }



    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('ingredients', 'like', '%' . $search . '%')
                ->orWhereHas('category', fn ($query) => $query->where('name', 'like', '%' . $search . '%'))->where("deleted", false)
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
