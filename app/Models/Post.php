<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;

class Post extends Model
{
    use SoftDeletes, Sluggable;

    protected $fillable = ['title', 'description', 'image', 'slug'];

  
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getHumanReadableDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M Y, H:i');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

   
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
