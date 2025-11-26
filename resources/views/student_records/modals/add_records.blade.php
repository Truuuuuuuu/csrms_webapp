<!-- Add Student Modal -->
<div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('student.records.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRecordModalLabel">Add Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Student Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="AGUILAR, JETHRUEL M." required>
                    </div>
                    <div class="mb-3">
                        <label for="uploaded_by" class="form-label">Uploaded By</label>
                        <input type="text" name="uploaded_by" class="form-control" id="uploaded_by" value="{{ auth()->user()->name }}" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Student</button>
                </div>
            </div>
        </form>
    </div>
</div>
