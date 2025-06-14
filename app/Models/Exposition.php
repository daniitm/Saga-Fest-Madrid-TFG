<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exposition extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'contact_person',
        'email',
        'phone',
        'website',
        'stand_category',
        'stand_size',
        'wired_internet',
        'audio_sound_configuration',
        'event_start_time',
        'event_end_time',
        'space_id',
        'schedule_id',
        'short_description',
        'special_requirements',
        'additional_information',
    ];

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function expositor()
    {
        return $this->hasOne(Expositor::class);
    }
}
