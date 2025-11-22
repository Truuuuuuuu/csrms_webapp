document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.action-btn.update').forEach(btn => {
        btn.addEventListener('click', function() {
            const userId = this.dataset.userId;
            const username = this.dataset.username;
            const modal = document.getElementById('changePasswordModal');

            // Populate hidden input
            modal.querySelector('input[name="user_id"]').value = userId;

            // Update modal title
            modal.querySelector('.modal-title').textContent = `Change Password for ${username}`;
        });
    });
});
