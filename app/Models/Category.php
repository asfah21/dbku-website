<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name']; // Only name field

    public function blogs() {
        return $this->belongsToMany(Blog::class, 'blog_category');
    }

    // public function scopeWhereName($query, $name)
    // {
    //     return $query->where('name', 'LIKE', str_replace(' ', '%', $name));
    // }


}
