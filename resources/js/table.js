document.addEventListener('DOMContentLoaded', () => {
    console.log('[table.js] loaded');

    const tableContainer = document.querySelector('.table');
    const panel = document.querySelector('.admin-panel');

    console.log('[table.js] .table:', tableContainer);
    console.log('[table.js] .admin-panel:', panel);

    if (!tableContainer || !panel) return;

    tableContainer.addEventListener('click', async (event) => {
        const editBtn = event.target.closest('.edit-button');
        if (editBtn) {
            const endpoint = editBtn.dataset.endpoint;

            const response = await fetch(endpoint, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            const result = await response.json();

            document.dispatchEvent(new CustomEvent('showForm', {
                detail: { data: result }
            }));
            return;
        }

        const delBtn = event.target.closest('.delete-button');
        if (delBtn) {
            const id = delBtn.dataset.id;
            const endpoint = panel.dataset.deleteUrl.replace('__ID__', id);

            console.log('[table.js] delete id:', id);
            console.log('[table.js] delete endpoint:', endpoint);

            document.dispatchEvent(new CustomEvent('showDeleteModal', {
                detail: { endpoint, elementId: id }
            }));
        }
    });
});
