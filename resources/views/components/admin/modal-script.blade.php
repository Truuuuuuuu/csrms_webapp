{{-- Modal Auto-Open Script Component --}}
@push('scripts')
<script>
    // Auto-open modal if there are validation errors
    @if($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            var modal = new bootstrap.Modal(document.getElementById('addUserModal'));
            modal.show();
        });
    @endif
</script>
@endpush

