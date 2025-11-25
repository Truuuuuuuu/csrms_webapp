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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // student name input
            'form_137' => 'nullable|file|mimes:pdf|max:2048',
            'certification' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'uploaded_by' => Auth::user()->username,
        ];

        if ($request->hasFile('form_137')) {
            $file = $request->file('form_137');
            $filename = time() . '_form137_' . $file->getClientOriginalName();
            $file->storeAs('public/pdfs', $filename);
            $data['form_137'] = $filename;
        }

        if ($request->hasFile('certification')) {
            $file = $request->file('certification');
            $filename = time() . '_cert_' . $file->getClientOriginalName();
            $file->storeAs('public/pdfs', $filename);
            $data['certification'] = $filename;
        }

        StudentRecord::create($data);

        return redirect()->back()->with('success', 'Record uploaded successfully.');
    }

    public function destroy(StudentRecord $record)
    {
        // Delete PDFs from storage
        if ($record->form_137) Storage::delete('public/pdfs/' . $record->form_137);
        if ($record->certification) Storage::delete('public/pdfs/' . $record->certification);

        $record->delete();

        return redirect()->back()->with('success', 'Record deleted successfully.');
    }
}
