@props(['id', 'title', 'inputName', 'accept' => 'application/pdf', 'multiple' => true, 'action'])

<div class="modal fade" id="{{ $id }}" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <label class="form-label">Select File{{ $multiple ? 's' : '' }}</label>
                <input type="file" name="{{ $inputName }}{{ $multiple ? '[]' : '' }}" class="form-control"
                    accept="{{ $accept }}" {{ $multiple ? 'multiple' : '' }} required>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
        </form>
    </div>
</div>