<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',           
        'form_137',
        'certification',
        'uploaded_by',
    ];

    // Helpers to get full PDF URLs
    public function form137Url()
    {
        return $this->form_137 ? asset('storage/pdfs/' . $this->form_137) : null;
    }

    public function certificationUrl()
    {
        return $this->certification ? asset('storage/pdfs/' . $this->certification) : null;
    }
}
