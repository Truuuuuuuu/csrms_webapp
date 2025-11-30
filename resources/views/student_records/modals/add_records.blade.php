<!-- Add Student Modal -->
<div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('student.records.store') }}" method="POST">
            @csrf
            <div class="modal-content shadow-lg rounded-4 border-0 p-4 add-student-modal">

                <!-- Modal Header -->
                <div class="add-student-modal-header">
                    <button type="button" class="add-student-modal-close" data-bs-dismiss="modal"
                        aria-label="Close">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="add-student-modal-body">
                    <div class="form-group">
                        <label for="name">Student Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="AGUILAR, JETHRUEL M."
                            required>
                    </div>
                    <div class="form-group">
                        <label for="uploaded_by">Uploaded By</label>
                        <input type="text" name="uploaded_by" class="form-control" id="uploaded_by"
                            value="{{ auth()->user()->name ?? auth()->user()->username }}" readonly>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="add-student-modal-footer">
                    <button type="submit" class="btn btn-success add-student-btn">
                        Add Student
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>