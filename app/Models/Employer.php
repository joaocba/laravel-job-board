<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = ['company_name'];

    // This will return all the jobs that belong to the employer
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    // This will return the user that owns the employer 1:1 relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
