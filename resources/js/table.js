import store from './redux/store';
import { setForm, setTable, setFilterQuery } from './redux/crud-slice';

const tableContainer = document.querySelector('.table');
const panel = document.querySelector('.admin-panel');
let table = null

if (tableContainer) {
    store.subscribe(() => {
        const currentState = store.getState()

        if (currentState.crud.table !== table) {
            tableContainer.innerHTML = currentState.crud.table
            table = currentState.crud.table
        }
    })

    tableContainer.addEventListener('click', async (event) => {

        if (event.target.closest('.edit-button')) {
            const editBtn = event.target.closest('.edit-button');
            const endpoint = editBtn.dataset.endpoint;

            const response = await fetch(endpoint, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            const result = await response.json();

            store.dispatch(setForm(result.form));
        }

        if (event.target.closest('.delete-button')) {
            const delBtn = event.target.closest('.delete-button');
            const id = delBtn.dataset.id;
            const endpoint = panel.dataset.deleteUrl.replace('__ID__', id);

            document.dispatchEvent(new CustomEvent('showDeleteModal', { detail: { endpoint } }));
        }


        if (event.target.closest('.table-pagination-page')) {

            const paginationButton = event.target.closest('.table-pagination-page')

            if (paginationButton.classList.contains('inactive')) {
                return
            }

            try {

                let endpoint = paginationButton.dataset.pagination
                let filterQuery = store.getState().crud.filterQuery

                if (filterQuery) {
                    endpoint += '&' + filterQuery
                }

                const response = await fetch(endpoint, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    method: 'GET',
                })

                if (response.status === 500) {
                    throw response
                }

                const json = await response.json()
                store.dispatch(setTable(json.table))

            } catch (error) {

                const json = await error.json()

                document.dispatchEvent(new CustomEvent('notification', {
                    detail: {
                        message: json.message,
                        type: 'error'
                    }
                }))
            }
        }

        if (event.target.closest('.filter-button')) {
            const modal = document.querySelector('.filter-modal');
            modal.classList.add('active');
        }

        if (event.target.closest('.modal__close')) {
            const modal = document.querySelector('.filter-modal');
            modal.classList.remove('active');
        }

        if (event.target.closest('.filter-cancel-button')) {
            const modal = document.querySelector('.filter-modal');
            modal.classList.remove('active');
        }

        if (event.target.closest('.filter-apply-button')) {
            const modal = document.querySelector('.filter-modal');
            const form = modal.querySelector('form')
            const formData = new FormData(form)
            const endpoint = panel.dataset.indexUrl

            const queryString = new URLSearchParams(formData).toString()
            const url = endpoint + '?' + queryString

            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
                method: 'GET',
            })

            const json = await response.json()
            store.dispatch(setTable(json.table))
            store.dispatch(setFilterQuery(queryString))

            modal.classList.remove('active');
        }

    });
}
