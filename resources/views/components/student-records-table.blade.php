@props([
    'records', 
    'showAction' => true
])

<div class="mb-4">
    {{-- Search Form --}}
    <form method="GET" class="mb-3" id="searchForm">

        <div class="input-group">

            {{-- Container for input + X button --}}
            <div class="position-relative flex-grow-1">

                {{-- Search Input --}}
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    class="form-control pe-5"
                    placeholder="Search student name..."
                    id="searchInput"
                >

                {{-- Clear (X) Button --}}
                @if(request('search'))
                    <button 
                        type="button" 
                        id="clearSearch"
                        class="btn position-absolute top-50 end-0 translate-middle-y p-0 me-2"
                        style="border: none; background: transparent; z-index: 10;"
                    >
                        <i class="bi bi-x-circle" style="font-size: 1.2rem; cursor: pointer;"></i>
                    </button>
                @endif
            </div>

            {{-- SEARCH BUTTON --}}
            <button class="btn btn-primary" type="submit">
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



    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Student Name</th>
                    <th>Updated At</th>
                    @if($showAction)
                        <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($records as $record)
                    <tr>
                        <td>{{ $record->name ?? 'N/A' }}</td>
                        <td>{{ $record->updated_at->format('Y-m-d') }}</td>
                        @if($showAction)
                            <td>
                                <a href="{{ route('student_records.show', $record->id) }}"
                                   class="btn btn-success btn-sm">
                                    <i class="bi bi-info-circle me-1"></i> View Records
                                </a>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $showAction ? 3 : 2 }}" class="text-center text-muted fst-italic">
                            No records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="pagination-wrapper mt-3 text-center">
        <div class="pagination-buttons">
            {{ $records->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>
