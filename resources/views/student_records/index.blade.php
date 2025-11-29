@extends('layouts.app')

@section('title', 'Student Records')

@section('content')
    <div class="main-content">

        {{-- Success Message --}}
        @if(session('success'))
            <div id="successBanner" class="alert alert-success success-banner">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Add Record Button --}}
        @php
            $allowedRoles = ['superadmin', 'admin', 'editor'];
        @endphp
        @if(auth()->check() && in_array(auth()->user()->role, $allowedRoles))
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addRecordModal">
                <i class="bi bi-file-earmark-plus"></i> Add New Student
            </button>
        @endif

        {{-- Search Form --}}
        <form method="GET" action="{{ route('student.records') }}" class="mb-2" id="searchForm">
            <div class="input-group">

                {{-- Container for input + X button --}}
                <div class="position-relative flex-grow-1">

                    {{-- Search Input --}}
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control search-input pe-5"
                        placeholder="Search by id, name..." id="searchInput">

                    {{-- Clear (X) Button --}}
                    @if(request('search'))
                        <button type="button" id="clearSearch"
                            class="btn position-absolute top-50 end-0 translate-middle-y p-0 me-2"
                            style="border: none; background: transparent; z-index: 10;">
                            <i class="bi bi-x" style="font-size: 1.6rem; cursor: pointer;"></i>
                        </button>
                    @endif

                </div>

                {{-- Search Button --}}
                <button type="submit" class="btn search-btn">
                    <i class="bi bi-search"></i> Search
                </button>

            </div>
        </form>

        {{-- Clear button JS --}}
        <script>
            document.getElementById('clearSearch')?.addEventListener('click', function () {
                document.getElementById('searchInput').value = '';
                document.getElementById('searchForm').submit();
            });
        </script>

        {{-- Student Records Table --}}
        <div class="student-records-wrapper table-responsive">
            <table class="table table-striped table-bordered student-records-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student</th>
                        <th>Records</th>
                        <th>Created By</th>
                        <th>Uploaded At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $record)
                        <tr>
                            <td data-label="ID" title="{{ $record->id }}">{{ $record->id }}</td>
                            <td data-label="Student" title="{{ $record->name }}">{{ $record->name ?? 'N/A' }}</td>
                            <td data-label="Details">
                                <a href="{{ route('student_records.show', $record->id) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-info-circle me-1"></i> View
                                </a>
                            </td>
                            <td data-label="Created By" title="{{ $record->uploaded_by }}">{{ $record->uploaded_by ?? 'N/A' }}
                            </td>
                            <td data-label="Uploaded At" title="{{ $record->created_at->format('Y-m-d') }}">
                                {{ $record->created_at->format('Y-m-d') }}
                            </td>
                            <td data-label="Action">
                                @if(auth()->check() && in_array(auth()->user()->role, ['superadmin', 'admin', 'editor']))
                                    {{-- Edit button --}}
                                    <form class="d-inline">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editRecordModal{{ $record->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    </form>

                                    {{-- Delete --}}
                                    <form action="{{ route('student.records.destroy', $record->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn remove-btn btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">Unavailable</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted fst-italic">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <x-pagination :paginator="$records" />
    </div>


    </div>

    {{-- Include Add Record Modal --}}
    @include('student_records.modals.add_records')
    @include('student_records.modals.edit_name')


@endsection