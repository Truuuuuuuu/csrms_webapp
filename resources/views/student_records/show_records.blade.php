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

            <div class="d-flex justify-content-between mb-3">
                <h5 class="fw-bold">Academic Records</h5>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addAcademicModal">
                    + Add Academic Record
                </button>
            </div>

            <div class="file-preview-box">
                @if($record->academicFiles->count() > 0)
                    @foreach($record->academicFiles as $file)
                        <p>
                            <a href="{{ asset('storage/pdfs/academic_records/' . $file->filename) }}" target="_blank">
                                {{ $file->filename }}
                            </a>
                        <form action="{{ route('student.files.destroy', $file->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Remove</button>
                        </form>
                        </p>
                    @endforeach



                @else
                    <p class="text-muted fst-italic">No academic record uploaded.</p>
                @endif
            </div>

        </div>

        {{-- Certification --}}
        <div class="tab-pane fade" id="certificationTab" role="tabpanel">

            <div class="d-flex justify-content-between mb-3">
                <h5 class="fw-bold">Certification</h5>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCertModal">
                    + Add Certification
                </button>
            </div>

            <div class="file-preview-box">
                @if($record->certFiles->count() > 0)
                    @foreach($record->certFiles as $file)
                        <p>
                            <a href="{{ asset('storage/pdfs/certification/' . $file->filename) }}" target="_blank">
                                {{ $file->filename }}
                            </a>
                        <form action="{{ route('student.files.destroy', $file->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Remove</button>
                        </form>
                        </p>
                    @endforeach
                @else
                    <p class="text-muted fst-italic">No certification uploaded.</p>
                @endif
            </div>

        </div>

        {{-- ==================== MODALS ==================== --}}
        {{-- Add Academic Modal --}}
        <div class="modal fade" id="addAcademicModal" tabindex="-1">
            <div class="modal-dialog">
                <form class="modal-content" action="{{ route('student.records.upload', $record->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Upload Academic Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <label class="form-label">Select PDF</label>
                        <input type="file" name="academic_records[]" class="form-control" accept="application/pdf" multiple>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Add Certification Modal --}}
        <div class="modal fade" id="addCertModal" tabindex="-1">
            <div class="modal-dialog">
                <form class="modal-content" action="{{ route('student.records.upload', $record->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Upload Certification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <label class="form-label">Select PDF</label>
                        <input type="file" name="certification[]" class="form-control" accept="application/pdf" multiple>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                </form>
            </div>
        </div>


@endsection