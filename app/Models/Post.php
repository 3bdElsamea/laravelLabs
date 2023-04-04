<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    // For update
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    // User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Comments
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // Human readable Date function
    public function getReadableDateAttribute()
    {
        return date('Y-m-d H:i:s', strtotime($this->created_at));
        // return $this->created_at->isoFormat('Do-MMMM-YYYY, h:mm:ss A');
        // return $this->created_at->diffForHumans();
    }
}
