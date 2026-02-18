document.addEventListener('DOMContentLoaded', () => {

    document.addEventListener('showFilterModal', function () {
        const modal = document.getElementById('filterModal');
        if (modal) modal.classList.add('active');
    });

    const cancelBtn = document.querySelector('#filterModal .cancel-button');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', () => {
            document.getElementById('filterModal').classList.remove('active');
        });
    }

    const applyBtn = document.querySelector('#filterModal .apply-button');
    if (applyBtn) {
        applyBtn.addEventListener('click', () => {

            const filterForm = document.getElementById('filterForm');
            const formData = new FormData(filterForm);
            const params = new URLSearchParams();

            for (const [key, value] of formData.entries()) {
                if (value) params.append(key, value);
            }

            window.location.href = `?${params.toString()}`;
        });
    }

    document.addEventListener('showDeleteModal', function (event) {
        const { endpoint } = event.detail;

        if (confirm('¿Estás seguro de eliminar este registro?')) {

            fetch(endpoint, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(() => window.location.reload())
                .catch(() => alert('Error al eliminar'));

        }
    });

});
