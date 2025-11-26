document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('floatingAddBtn');
    if(!btn) return;

    btn.addEventListener('click', function() {
        const activeTab = document.querySelector('.tab-pane.show.active')?.id;
        if(!activeTab) return;

        if(activeTab === 'academicTab') {
            new bootstrap.Modal(document.getElementById('addAcademicModal')).show();
        } else if(activeTab === 'certificationTab') {
            new bootstrap.Modal(document.getElementById('addCertModal')).show();
        }
    });
});
