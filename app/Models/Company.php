<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Company extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    public $sortable = ['id', 'name'];

    protected $fillable = [
        'name'
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
