<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $table = 'stories';

    protected $fillable = [
        'user_id',
        'date',
        'title',
        'description',
        'image',
        'story_type',
        'order'
    ];

    protected $casts = [
        'date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke User (jika diperlukan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope untuk story type
    public function scopeByType($query, $type)
    {
        return $query->where('story_type', $type);
    }

    // Scope untuk ordering
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    // Accessor untuk image URL
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/stories/' . $this->image);
        }
        return null;
    }

    // Mutator untuk image
    public function setImageAttribute($value)
    {
        if ($value) {
            $this->attributes['image'] = $value;
        }
    }
}
