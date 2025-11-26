<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'uploaded_by',
    ];

    // Relationship: One student record has many files
    public function files()
    {
        return $this->hasMany(StudentFile::class);
    }

    // Helper methods to get files by type
    public function academicFiles()
    {
        return $this->files()->where('type', 'academic');
    }

    public function certFiles()
    {
        return $this->files()->where('type', 'cert');
    }
}
