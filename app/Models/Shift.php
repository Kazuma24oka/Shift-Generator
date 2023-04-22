<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'date', 'start_time', 'end_time'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public static function dateList()
    {
        $startDate = new \DateTime('now');
        $endDate = (clone $startDate)->modify('+1 month');
        $dates = [];

        while ($startDate <= $endDate) {
            if ($startDate->format('N') <= 5) {
                $dates[] = $startDate->format('Y-m-d');
            }
            $startDate->modify('+1 day');
        }

        return $dates;
    }
}