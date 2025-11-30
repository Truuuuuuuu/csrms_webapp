{{-- Change Password Modal --}}
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.users.change_password.post') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ old('user_id') }}">

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="change_password" class="form-label">New Password</label>
                        <input type="password" class="form-control @error('change_password') is-invalid @enderror"
                            name="change_password" required>
                        @error('change_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="change_password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password"
                            class="form-control @error('change_password_confirmation') is-invalid @enderror"
                            name="change_password_confirmation" required>
                        @error('change_password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

