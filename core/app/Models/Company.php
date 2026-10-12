<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'website',
        'location',
        'description',
    ];

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
