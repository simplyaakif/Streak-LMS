<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class StaffAttendance extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'staff_attendances';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const STATUS_RADIO = [
        'Present' => 'Present',
        'Absent'  => 'Absent',
        'Leave'   => 'Leave',
        'Late'    => 'Late',
        'Other'   => 'Other',
    ];

    protected $fillable = [
        'employee_id',
        'status',
        'date',
        'comment',
        'taken_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function taken_by()
    {
        return $this->belongsTo(User::class, 'taken_by_id');
    }
}
