<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Category extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'image'
    ];

    protected static function booted()
    {
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }



    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where('name', 'like', '%' . $search . '%')
        );
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value != null ? url($value) : null,
            set: fn ($value) => $value,
        );
    }



    public function foods()
    {
        return $this->hasMany(Food::class, "category_id");
    }
}
