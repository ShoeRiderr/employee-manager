<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Employee extends Model
{
    use HasFactory, SoftDeletes, Sortable;

	public $sortable = ['first_name', 'last_name', 'email'];

    protected $fillable = [
        'company_id',
        'food_preference_id',
        'email',
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
