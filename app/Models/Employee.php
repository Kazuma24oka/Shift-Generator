<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'preferred_working_days', 'preferred_days_off', 'min_working_days', 'store_id', 'preferred_store_id', 'incompatible_employee_id'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function preferred_store()
    {
        return $this->belongsTo(Store::class);
    }

    public function incompatible_employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // 任意の追加メソッドやスコープが必要であれば、ここに追加します
}