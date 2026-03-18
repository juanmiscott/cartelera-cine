import store from './redux/store';
import { setForm, setTable } from './redux/crud-slice';

const deleteModal = document.getElementById('deleteModal');

if (deleteModal) {
    document.addEventListener('showDeleteModal', function (event) {
        deleteModal.dataset.endpoint = event.detail.endpoint;
        deleteModal.classList.add('active');
    });

    deleteModal.addEventListener('click', async event => {
        if (event.target.closest('.cancel-button')) {
            deleteModal.classList.remove('active');
        }

        if (event.target.closest('.confirm-button')) {
            const endpoint = deleteModal.dataset.endpoint;

            try {
                const response = await fetch(endpoint, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) throw new Error();

                deleteModal.classList.remove('active');

                const data = await response.json();

                store.dispatch(setTable(data.table));
                store.dispatch(setForm(data.form));

            } catch (error) {
                console.error(error);
                deleteModal.classList.remove('active');
            }
        }
    });
}