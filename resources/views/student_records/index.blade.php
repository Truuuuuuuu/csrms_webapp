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
        @php
            $allowedRoles = ['superadmin', 'admin', 'editor'];
        @endphp
        @if(auth()->check() && in_array(auth()->user()->role, $allowedRoles))
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addRecordModal">
                Add Student Record
            </button>
        @endif

        {{-- Search Form --}}
        <form method="GET" action="{{ route('student.records') }}" class="mb-3" id="searchForm">
            <div class="input-group">

                {{-- Container for input + X button --}}
                <div class="position-relative flex-grow-1">

                    {{-- Search Input --}}
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control pe-5"
                        placeholder="Search by username or role..." id="searchInput">

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
                <button type="submit" class="btn btn-primary">
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
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Student</th>
                        <th>Details</th>
                        <th>Created By</th>
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
                                <a href="{{ route('student_records.show', $record->id) }}" class="btn btn-success btn-sm">
                                    <i class="bi bi-info-circle me-1"></i> View Records
                                </a>

                            </td>
                            <td>{{ $record->uploaded_by ?? 'N/A' }}</td>
                            <td>{{ $record->created_at->format('Y-m-d') }}</td>
                            <td>
                                @if(auth()->check() && in_array(auth()->user()->role, ['superadmin', 'admin', 'editor']))
                                    <form action="{{ route('student.records.destroy', $record->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                    </form>
                                @else
                                    <span class="text-muted">Unavailable</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <!-- Pagination -->
        <div class="mt-3 text-center" >
            {{ $records->links('pagination::bootstrap-5') }}
        </div>

    </div>

    {{-- Include Add Record Modal --}}
    @include('student_records.modals.add_records')

@endsection