<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Query extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'queries';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'name',
        'mobile_number',
        'email',
    ];

    protected $fillable = [
        'name',
        'mobile_number',
        'email',
        'dealt_by_id',
        'address',
        'comments_remarks',
        'interaction_type_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function dealt_by()
    {
        return $this->belongsTo(User::class, 'dealt_by_id');
    }

    public function interaction_type()
    {
        return $this->belongsTo(QueryInteractionType::class, 'interaction_type_id');
    }
}
