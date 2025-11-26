@extends('layouts.app')

@section('title', 'Student Records')

@section('content')

    {{-- Tabs Navigation --}}
    <ul class="nav nav-tabs mb-3" id="recordTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="academic-tab" data-bs-toggle="tab" data-bs-target="#academicTab"
                type="button" role="tab">Academic Records</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="certification-tab" data-bs-toggle="tab" data-bs-target="#certificationTab"
                type="button" role="tab">Certification</button>
        </li>
    </ul>

    <div class="tab-content" id="recordTabsContent">

        {{-- Academic Records --}}
        <div class="tab-pane fade show active" id="academicTab" role="tabpanel">

            <div class="file-preview-box">
                @if($record->academicFiles->count() > 0)
                    @foreach($record->academicFiles as $file)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <a href="{{ asset('storage/pdfs/academic_records/' . $file->filename) }}" target="_blank">
                                {{ $file->filename }}
                            </a>
                            <form action="{{ route('student.files.destroy', $file->id) }}" method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted fst-italic">No academic record uploaded.</p>
                @endif
            </div>

        </div>

        {{-- Certification --}}
        <div class="tab-pane fade" id="certificationTab" role="tabpanel">

            <div class="file-preview-box">
                @if($record->certFiles->count() > 0)
                    @foreach($record->certFiles as $file)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <a href="{{ asset('storage/pdfs/certification/' . $file->filename) }}" target="_blank">
                                {{ $file->filename }}
                            </a>
                            <form action="{{ route('student.files.destroy', $file->id) }}" method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted fst-italic">No certification uploaded.</p>
                @endif
            </div>

        </div>

    </div>
    {{-- Add Academic Modal --}}
    <x-add-file-modal id="addAcademicModal" title="Upload Academic Record" inputName="academic_records"
        action="{{ route('student.records.upload', $record->id) }}" />

    {{-- Add Certification Modal --}}
    <x-add-file-modal id="addCertModal" title="Upload Certification" inputName="certification"
        action="{{ route('student.records.upload', $record->id) }}" />

    {{-- Floating Add Button --}}
    <button type="button" class="floating-add-btn" id="floatingAddBtn" title="Add File">
        <i class="bi bi-plus-lg"></i>
    </button>

@endsection