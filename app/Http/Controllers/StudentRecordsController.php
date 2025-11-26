<?php

namespace App\Http\Controllers;

use App\Models\StudentRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentRecordsController extends Controller
{
    public function index()
    {
        // Get all student records
        $records = StudentRecord::all();
        return view('student_records.index', compact('records'));
    }

    protected function handleFiles($files, StudentRecord $record, $type, $path)
    {
        if (!$files)
            return;

        // Wrap single file into array if needed
        $files = is_array($files) ? $files : [$files];

        foreach ($files as $file) {
            $filename = time() . "_{$type}_" . $file->getClientOriginalName();
            $file->storeAs($path, $filename, 'public');

            $record->files()->create([
                'type' => $type,
                'filename' => $filename,
                'uploaded_by' => auth()->user()->username, 
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'academic_records.*' => 'nullable|file|mimes:pdf|max:2048',
            'certification.*' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $record = StudentRecord::create([
            'name' => $request->name,
            'uploaded_by' => Auth::user()->username,
        ]);

        // Helper to process files
        $this->handleFiles($request->file('academic_records'), $record, 'academic', 'pdfs/academic_records');
        $this->handleFiles($request->file('certification'), $record, 'cert', 'pdfs/certification');

        return redirect()->back()->with('success', 'Record uploaded successfully.');
    }


    public function update(Request $request, StudentRecord $record)
    {
        $request->validate([
            'academic_records.*' => 'nullable|file|mimes:pdf|max:2048',
            'certification.*' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $this->handleFiles($request->file('academic_records'), $record, 'academic', 'pdfs/academic_records');
        $this->handleFiles($request->file('certification'), $record, 'cert', 'pdfs/certification');

        return redirect()->back()->with('success', 'Files uploaded successfully.');
    }


    public function destroy(StudentRecord $record)
    {
        foreach ($record->files as $file) {
            $path = $file->type === 'academic'
                ? 'pdfs/academic_records/' . $file->file_name
                : 'pdfs/certification/' . $file->file_name;

            Storage::disk('public')->delete($path);
            $file->delete();
        }

        $record->delete();

        return redirect()->back()->with('success', 'Record deleted successfully.');
    }

    public function show(StudentRecord $record)
    {
        return view('student_records.show_records', compact('record'));
    }

}
