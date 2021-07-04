<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    const TYPE_RATE = 'rate';
    const TYPE_HOURLY_PAYMENT = 'hourly payment';

    protected $appends = ['monthly_payment'];

    public function department()
    {
        return $this->hasOne(Department::class);
    }

    public function getMonthlyPaymentAttribute()
    {
        if ($this->type === self::TYPE_HOURLY_PAYMENT) {
            return $this->amount * $this->working_hours;
        }

        return $this->amount;
    }
}
