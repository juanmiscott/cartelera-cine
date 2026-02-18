document.addEventListener('DOMContentLoaded', () => {
    console.log('[form.js] loaded');

    const panel = document.querySelector('.admin-panel');
    const formContainer = document.querySelector('.form');
    const form = document.querySelector('.form form');

    console.log('[form.js] .admin-panel:', panel);
    console.log('[form.js] .form:', formContainer);
    console.log('[form.js] form:', form);

    if (!panel || !formContainer || !form) return;

    document.addEventListener('showForm', (event) => {
        loadFormData(event.detail.data);
    });

    formContainer.addEventListener('click', (event) => {
        event.preventDefault();

        if (event.target.closest('.save-icon')) {
            const formData = new FormData(form);
            const json = {};
            for (const [k, v] of formData.entries()) json[k] = v !== '' ? v : null;

            const id = (json.id || '').toString().trim();
            let endpoint = panel.dataset.storeUrl;

            if (id) {
                endpoint = panel.dataset.updateUrl.replace('__ID__', id);
                json._method = 'PUT';
            }
            delete json.id;

            console.log('[form.js] save endpoint:', endpoint);
            console.log('[form.js] payload:', json);

            fetch(endpoint, {
                method: 'POST',
                body: JSON.stringify(json),
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
                .then(async (res) => {
                    const data = await res.json().catch(() => ({}));

                    if (!res.ok) {
                        console.error('[form.js] save error', res.status, data);
                        alert(data.message || `Error al guardar (${res.status})`);
                        return;
                    }

                    alert(data.message || 'Guardado correctamente');
                    form.reset();
                    document.querySelector('[name="id"]').value = '';
                    window.location.reload();
                })
                .catch((err) => {
                    console.error(err);
                    alert('Error de red al guardar');
                });
        }

        if (event.target.closest('.clean-icon')) {
            form.reset();
            document.querySelector('[name="id"]').value = '';
        }
    });

    function loadFormData (data) {
        form.reset();
        Object.entries(data).forEach(([key, value]) => {
            const input = document.querySelector(`[name="${key}"]`);
            if (input) input.value = value ?? '';
        });
    }
});
