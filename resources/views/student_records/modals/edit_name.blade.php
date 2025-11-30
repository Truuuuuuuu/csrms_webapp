@foreach($records as $record)
    <div class="modal fade" id="editRecordModal{{ $record->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content edit-user-modal">
                <form action="{{ route('student.records.updateName', $record->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Modal Header -->
                    <div class="edit-user-modal-header">
                        <h5 class="edit-user-modal-title">Edit Student Name</h5>
                        <button type="button" class="edit-user-modal-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="edit-user-modal-body">
                        <div class="form-group">
                            <label for="name-{{ $record->id }}">Student Name</label>
                            <input type="text" name="name" class="form-control" id="name-{{ $record->id }}"
                                value="{{ $record->name }}" required>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="edit-user-modal-footer">
                        <button type="submit" class="btn btn-primary edit-user-btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach