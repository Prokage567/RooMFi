<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    protected $fillable = [
        "date",
        "teacher_id",
        "section_id",
        "room_id",
        "day",
        "end_time",
        "start_time",
        "subject",
    ];
    protected $dates = ["start_time", "end_time"];
    protected $dateFormat = 'g:i A';

    public $timestamps = false;
}
