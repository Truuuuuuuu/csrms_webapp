<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFile extends Model
{
    use HasFactory;

    protected $fillable = ['student_record_id', 'filename', 'type','uploaded_by'];

    public function studentRecord()
    {
        return $this->belongsTo(StudentRecord::class);
    }
}
