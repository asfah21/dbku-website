<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'title',
        'slug',
        'description',
        'image_1',
        'image_2',
        'image_3',
        'font_file',
        'status'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            $blog->slug = Str::slug($blog->title);
        });

        static::updating(function ($blog) {
            $blog->slug = Str::slug($blog->title);
        });
    }

    public static function createSlug($title)
    {
        $slug = Str::slug($title);
        $count = Blog::where('slug', 'LIKE', "{$slug}%")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'blog_category');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'blog_tag');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


}
