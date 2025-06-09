<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Clap;
use App\Models\Category;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia

{
    use HasFactory, Sluggable, InteractsWithMedia;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'category_id',
        'user_id',
        'published_at',
    ];
    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];


    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->width(400)
            ->nonQueued();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'separator' => '_',       // Use underscores instead of dashes
                'unique' => true,          // Ensure unique slugs
                'onUpdate' => true,        // Update slug when title changes
                'maxLength' => 50,         // Limit slug length
                'method' => function ($string, $separator) {
                    return strtoupper(Str::slug($string, $separator));
                }
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function claps()
    {
        return $this->hasMany(Clap::class);
    }

    public function readTime($wordPerMinute = 200)
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $readTime = ceil($wordCount / $wordPerMinute);
        return $readTime;
    }
    
}
