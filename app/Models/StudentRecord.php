<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',           
        'academic_records',
        'certification',
        'uploaded_by',
    ];

    // Helpers to get full PDF URLs
    public function academic_recordsUrl()
    {
        return $this->academic_records ? asset('storage/pdfs/' . $this->academic_records) : null;
    }

    public function certificationUrl()
    {
        return $this->certification ? asset('storage/pdfs/' . $this->certification) : null;
    }
}
