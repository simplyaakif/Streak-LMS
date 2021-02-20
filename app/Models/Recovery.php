<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Recovery extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'recoveries';

    const IS_PAID_RADIO = [
        '1' => 'Paid',
    ];

    protected $dates = [
        'paid_on',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'student_id',
        'batch_id',
        'amount',
        'is_paid',
        'paid_on',
        'payment_type_id',
        'reference_number',
        'comments',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function getPaidOnAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setPaidOnAttribute($value)
    {
        $this->attributes['paid_on'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function payment_type()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }
}
