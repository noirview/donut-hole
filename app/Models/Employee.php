<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'patronymic',
        'gender',
        'salary',
    ];

    public function getFullNameAttribute()
    {
        return join(' ', [
            $this->last_name,
            $this->name,
            $this->patronymic
        ]);
    }

    public function departments()
    {
        $this->belongsToMany(Department::class);
    }
}
