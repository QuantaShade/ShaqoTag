<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_posts';

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'budget',
        'type',
        'status',
        'skills',
        'location',
        'workplace_type',
        'deadline',
    ];

    protected function casts(): array
    {
        return [
            'skills' => 'array',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'job_id');
    }
}
