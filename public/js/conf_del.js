document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll('.confirm-remove').forEach(form => {
        form.addEventListener('submit', e => {
            e.preventDefault();

            if (confirm("Are you sure you want to remove this user?")) {
                form.submit();
            }
        });
    });

});
