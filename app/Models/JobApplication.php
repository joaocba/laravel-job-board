<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    use HasFactory;

    // This will allow the expected_salary, user_id, and job_id to be mass assigned
    protected $fillable = ['expected_salary', 'user_id', 'job_id', 'cv_path'];

    // This is the relationship between the JobApplication and Job models
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    // This is the relationship between the JobApplication and User models
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
