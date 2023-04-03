<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'preferred_working_days', 'preferred_days_off', 'min_working_days', 'store_id', 'preferred_store_id', 'incompatible_employee_id', 'store_needs_update'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    // 任意の追加メソッドやスコープが必要であれば、ここに追加します
}