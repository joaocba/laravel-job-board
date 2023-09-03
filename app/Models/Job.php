<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Job extends Model
{
    // Traits
    use HasFactory, SoftDeletes;

    // This will allow mass assignment for the following fields
    protected $fillable = ['title', 'location', 'salary', 'description', 'experience', 'category'];

    public static array $experience = ['entry', 'intermediate', 'senior']; // static means that this variable is shared across all instances of the class
    public static array $category = ['IT', 'Finance', 'Sales', 'Marketing'];

    // This will return the employer that owns the job
    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    // This will return the job applications that are associated with the job
    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }


    public function hasUserApplied(Authenticatable|User|int $user): bool
    {
        // This will return true if the user has applied to the job
        return $this->where('id', $this->id)
            ->whereHas(
                'jobApplications',
                fn($query) => $query->where('user_id', '=', $user->id ?? $user) // if $user is an instance of User, then use $user->id, else use $user, check if the user has applied to the job
            )->exists();
    }


    // This will filter the jobs by title, description, salary, experience and category. It is reusable
    public function scopeFilter(Builder | QueryBuilder $query, array $filters): Builder|QueryBuilder
    {
        // This will return the jobs that match the search criteria
        return $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhereHas('employer', function ($query) use ($search) { // pass relationship name and a closure to the orWhereHas() method
                        $query->where('company_name', 'like', '%' . request('search') . '%');
                    });
            });
        })->when($filters['min_salary'] ?? null, function ($query, $minSalary) {
            $query->where('salary', '>=', $minSalary);
        })->when($filters['max_salary'] ?? null, function ($query, $maxSalary) {
            $query->where('salary', '<=', $maxSalary);
        })->when($filters['experience'] ?? null, function ($query, $experience) {
            $query->where('experience', $experience);
        })->when($filters['category'] ?? null, function ($query, $category) {
            $query->where('category', $category);
        });
    }


}
