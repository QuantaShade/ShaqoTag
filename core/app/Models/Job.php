<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
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
}
