@props([
    'records', 
    'totalRecords',
    'showAction' => true
])

<div class="mb-4">

    {{-- Search Form --}}
    <form method="GET" class="mb-3" id="searchForm">

        <div class="input-group">

            <div class="position-relative flex-grow-1">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    class="form-control search-input pe-5"
                    placeholder="Search student name..."
                    id="searchInput"
                >

                @if(request('search'))
                    <button 
                        type="button" 
                        id="clearSearch"
                        class="btn position-absolute top-50 end-0 translate-middle-y p-0 me-2"
                        style="border: none; background: transparent; z-index: 10;"
                    >
                        <i class="bi bi-x" style="font-size: 2rem; cursor: pointer;"></i>
                    </button>
                @endif
            </div>

            <button class="btn search-btn" type="submit">
                <i class="bi bi-search"></i> Search
            </button>

        </div>

    </form>

    {{-- JS Clear --}}
    <script>
        document.getElementById('clearSearch')?.addEventListener('click', function () {
            document.getElementById('searchInput').value = '';
            document.getElementById('searchForm').submit();
        });
    </script>

    {{-- Styled Table --}}
    <div class="student-records-wrapper table-responsive dashb-student-table">
        <table class="student-records-table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Updated At</th>
                    @if($showAction)
                        <th>Action</th>
                    @endif
                </tr>
            </thead>

            <tbody>
                @if($totalRecords === 0)
                    <tr>
                        <td colspan="{{ $showAction ? 3 : 2 }}" class="text-center text-muted fst-italic">
                            No records found.
                        </td>
                    </tr>
                @else
                    @foreach($records as $record)
                        <tr>
                            <td data-label="Student Name">{{ $record->name }}</td>
                            <td data-label="Updated At">{{ $record->updated_at->format('Y-m-d') }}</td>
                            @if($showAction)
                                <td data-label="Action">
                                    <a href="{{ route('student_records.show', $record->id) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-info-circle me-1"></i> View Records
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endif
            </tbody>


        </table>
    </div>

    <x-pagination :paginator="$records" />

</div>
