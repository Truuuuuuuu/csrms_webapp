@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
    <div class="dashboard-container">
        <h1 class="mb-4 text-center">Change Password for {{ $user->username }}</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('admin.users.change_password.post') }}" method="POST">
                    @csrf
                    {{-- Hidden input to hold the user ID --}}
                    <input type="hidden" name="user_id" value="{{ old('user_id') }}">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="change-pass-btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="change-pass-btn btn-success">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

{{-- Change Password Modal Auto-Open Script --}}
@push('scripts')
<script>
    @if($errors->any() && old('user_id'))
        document.addEventListener('DOMContentLoaded', function () {
            var modal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
            modal.show();

            // Populate user_id hidden input with old value
            modal.querySelector('input[name="user_id"]').value = "{{ old('user_id') }}";

            // Optionally update modal title if you also pass old('username')
            @if(old('username'))
                modal.querySelector('.modal-title').textContent = "Change Password for {{ old('username') }}";
            @endif
        });
    @endif
</script>
@endpush
