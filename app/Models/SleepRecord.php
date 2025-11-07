<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SleepRecord extends Model
{
    protected $fillable = [
        'student_id',
        'sleep_date',
        'day_sleep_start',
        'day_sleep_end',
        'night_sleep_start',
        'night_sleep_end',
        'day_sleep_hours',
        'night_sleep_hours'
    ];
    // Your model properties and relationships

    public function calculateTotalSleepHours()
    {
        $totalSleepHours = 0;

        if ($this->day_sleep_start && $this->day_sleep_end) {
            $daySleepStart = Carbon::parse($this->day_sleep_start);
            $daySleepEnd = Carbon::parse($this->day_sleep_end);
            $totalSleepHours += $daySleepEnd->diffInHours($daySleepStart);
        }

        if ($this->night_sleep_start && $this->night_sleep_end) {
            $nightSleepStart = Carbon::parse($this->night_sleep_start);
            $nightSleepEnd = Carbon::parse($this->night_sleep_end);
            $totalSleepHours += $nightSleepEnd->diffInHours($nightSleepStart);
        }

        return $totalSleepHours;
    }

}