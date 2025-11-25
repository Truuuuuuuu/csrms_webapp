@extends('layouts.app')

@section('title', 'Student Records')

@section('content')
    <div class="container">
        <h1 class="mb-4">Student Records</h1>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Add Record Button --}}
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addRecordModal">
            Add Student Record
        </button>

        {{-- Student Records Table --}}
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Student</th>
                        <th>Academic Records</th>
                        <th>Certification</th>
                        <th>Uploaded By</th>
                        <th>Uploaded At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td>{{ $record->id }}</td>
                            <td>{{ $record->name ?? 'N/A' }}</td>
                            <td>
                                @if($record->academic_records)
                                    <a href="{{ asset('storage/pdfs/academic_records/' . $record->academic_records) }}" target="_blank">
                                        {{ $record->academic_records }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($record->certification)
                                    <a href="{{ asset('storage/pdfs/certification/' . $record->certification) }}" target="_blank">
                                        {{ $record->certification }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $record->uploaded_by }}</td>
                            <td>{{ $record->created_at->format('Y-m-d') }}</td>
                            <td>
                                {{-- Delete Button --}}
                                <form action="{{ route('student.records.destroy', $record->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Include Add Record Modal --}}
    @include('student_records.modals.add_records')

@endsection