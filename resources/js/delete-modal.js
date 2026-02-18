document.addEventListener('DOMContentLoaded', () => {

    let deleteEndpoint = '';

    const modal = document.getElementById('deleteModal');
    if (!modal) return;

    const cancelBtn = modal.querySelector('.cancel-button');
    const confirmBtn = modal.querySelector('.confirm-button');

    document.addEventListener('showDeleteModal', function (event) {
        deleteEndpoint = event.detail.endpoint;
        modal.classList.add('active');
    });

    if (cancelBtn) {
        cancelBtn.addEventListener('click', () => {
            modal.classList.remove('active');
        });
    }

    if (confirmBtn) {
        confirmBtn.addEventListener('click', async () => {
            try {
                const response = await fetch(deleteEndpoint, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) {
                    throw new Error('Error al eliminar');
                }

                modal.classList.remove('active');
                window.location.reload();

            } catch (error) {
                console.error(error);
                alert('No se pudo eliminar el registro');
                modal.classList.remove('active');
            }
        });
    }

    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.classList.remove('active');
        }
    });

});
