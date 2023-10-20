<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    public array $fillables = [
        'company_id',
        'food_preference_id',
        'first_name',
        'last_name',
        'phone_numbers',
    ];

    protected $casts = [
        'phone_numbers' => 'array',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function foodPreference(): BelongsTo
    {
        return $this->belongsTo(FoodPreference::class);
    }
}
