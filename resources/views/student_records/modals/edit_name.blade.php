@foreach($records as $record)
    <div class="modal fade" id="editRecordModal{{ $record->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('student.records.updateName', $record->id) }}" method="POST" class="modal-content">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Student Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">Student Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $record->name }}" required>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                </div>

            </form>
        </div>
    </div>
@endforeach