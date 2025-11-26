document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('floatingAddBtn');
    if(btn) {
        btn.addEventListener('click', function() {
            const activeTab = document.querySelector('.tab-pane.active').id;
            if(activeTab === 'academicTab') {
                new bootstrap.Modal(document.getElementById('addAcademicModal')).show();
            } else if(activeTab === 'certificationTab') {
                new bootstrap.Modal(document.getElementById('addCertModal')).show();
            }
        });
    }
});
