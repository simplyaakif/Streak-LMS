<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;

class Employee extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'employees';

    public static $searchable = [
        'name',
    ];

    protected $appends = [
        'dp',
        'documents_cv_experience',
    ];

    const GENDER_SELECT = [
        'Male'   => 'Male',
        'Female' => 'Female',
    ];

    const EARNING_TYPE_SELECT = [
        'Salary'     => 'Salary',
        'Commission' => 'Commission',
    ];

    protected $dates = [
        'date_of_birth',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const MARITAL_STATUS_SELECT = [
        'Single'   => 'Single',
        'Married'  => 'Married',
        'Widow'    => 'Widow',
        'Divorced' => 'Divorced',
    ];

    protected $fillable = [
        'name',
        'user_id',
        'mobile',
        'email',
        'address',
        'city',
        'date_of_birth',
        'gender',
        'marital_status',
        'job_title',
        'cnic_passport',
        'qualification',
        'experience',
        'relegion',
        'earning_type',
        'basic_salary',
        'medical',
        'conveyance',
        'deduction_leave',
        'deduction_loan',
        'deduction_tax',
        'deduction_other',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getDpAttribute()
    {
        $file = $this->getMedia('dp')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getDateOfBirthAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDocumentsCvExperienceAttribute()
    {
        return $this->getMedia('documents_cv_experience');
    }
}
