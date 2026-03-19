import store from './redux/store';
import { setForm, setTable } from './redux/crud-slice';

const panel = document.querySelector('.admin-panel');
const formContainer = document.querySelector('.form');
let form = null

if (formContainer) {
    store.subscribe(() => {
        const currentState = store.getState()

        if (currentState.crud.form !== form) {
            formContainer.innerHTML = currentState.crud.form
            form = currentState.crud.form
        }
    })

    formContainer.addEventListener('click', async event => {

        if (event.target.closest('.save-icon')) {
            event.preventDefault();

            const form = document.querySelector('.form form');
            const formData = new FormData(form);

            const images = [];
            const uploadImageContainers = document.querySelectorAll('.upload-image-container');

            uploadImageContainers.forEach(container => {
                const img = container.querySelector('img');
                if (img && img.getAttribute('src')) {
                    images.push({
                        name: container.dataset.name,
                        languageAlias: container.dataset.language,
                        imageConfigurations: JSON.parse(container.dataset.configuration || '{}'),
                        filename: img.getAttribute('src').split('/').pop(),
                        alt: img.getAttribute('alt'),
                        title: img.getAttribute('title')
                    });
                }
            });

            formData.append('images', JSON.stringify(images));
            let endpoint = panel.dataset.storeUrl;

            try {
                const response = await fetch(endpoint, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })

                const data = await response.json()

                if (!response.ok) {
                    console.error('[form.js] save error', response.status, data);
                    alert(data.message || `Error al guardar (${response.status})`);
                    return;
                }

                store.dispatch(setTable(data.table));
                store.dispatch(setForm(data.form));

            } catch (error) {
                console.error(error);
            }
        }

        if (event.target.closest('.clean-icon')) {

            const response = await fetch(panel.dataset.createUrl, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            const result = await response.json();

            store.dispatch(setForm(result.form));
        }


        const mainTab = event.target.closest('.tabs--main .tab');
        if (mainTab) {
            const selected = mainTab.dataset.tab;

            formContainer.querySelectorAll('.tabs--main .tab').forEach(t => t.classList.remove('active'));
            mainTab.classList.add('active');

            formContainer.querySelectorAll('.tab-content').forEach(c => {
                c.classList.toggle('active', c.dataset.tab === selected);
            });
            return;
        }

        const langTab = event.target.closest('.tabs--lang .tab-lang');
        if (langTab) {
            const selected = langTab.dataset.lang;

            formContainer.querySelectorAll('.tabs--lang .tab-lang').forEach(t => t.classList.remove('active'));
            langTab.classList.add('active');

            formContainer.querySelectorAll('.tab-lang-content').forEach(c => {
                c.classList.toggle('active', c.dataset.lang === selected);
            });
            return;
        }




    });
}