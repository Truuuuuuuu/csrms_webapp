<?php

namespace App\Http\Controllers;

use App\Models\StudentRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentRecordsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Fetch records with search and pagination
        $records = StudentRecord::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('id', 'LIKE', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Ensure we redirect to first page if current page exceeds last page
        if ($records->currentPage() > $records->lastPage() && $records->lastPage() > 0) {
            return redirect()->route('student.records', ['search' => $search]);
        }
        $totalRecords = $records->total();
        return view('student_records.index', compact('records', 'totalRecords'));
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

        return redirect()->back()->with('success', 'Student added successfully.');
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

    public function updateName(Request $request, StudentRecord $record)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $record->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Student name updated successfully.');
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
