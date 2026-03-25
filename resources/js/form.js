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

            if (formContainer.querySelector('.upload-image-container')) {
                const images = []
                const uploadImageContainers = formContainer.querySelectorAll('.upload-image-container')

                uploadImageContainers.forEach(uploadImageContainer => {
                    const image = {
                        name: uploadImageContainer.dataset.name,
                        languageAlias: uploadImageContainer.dataset.language,
                        imageConfigurations: JSON.parse(uploadImageContainer.dataset.configuration),
                        files: []
                    }

                    uploadImageContainer.querySelectorAll('img').forEach(img => {
                        if (img.getAttribute('src')) {
                            image.files.push({
                                filename: img.getAttribute('src').split('/').pop(),
                                alt: img.getAttribute('alt'),
                                title: img.getAttribute('title')
                            })
                        }
                    })

                    if (image.files.length > 0) {
                        images.push(image)
                    }
                })

                if (images.length > 0) {
                    formData.append('images', JSON.stringify(images))
                }
            }

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

        if (event.target.closest('.image-button')) {
            const uploadImageContainer = event.target.closest('.upload-image-container');

            document.dispatchEvent(new CustomEvent('openImageModal', {
                detail: {
                    uploadImageContainer
                }
            }));
        }

        if (event.target.closest('.delete-image-button')) {
            const button = event.target.closest('.delete-image-button');
            const imageContainer = button.parentElement;
            const wrapper = imageContainer.parentElement;

            if (!imageContainer.classList.contains('hidden')) {
                imageContainer.remove();
            }

            if (wrapper.classList.contains('single')) {
                const addBtn = wrapper.querySelector('.image-button');
                if (addBtn) addBtn.classList.remove('hidden');
            }
        }

        if (event.target.closest('.tabs--main .tab')) {
            const mainTab = event.target.closest('.tabs--main .tab')
            const selected = mainTab.dataset.tab;

            formContainer.querySelectorAll('.tabs--main .tab').forEach(t => t.classList.remove('active'));
            mainTab.classList.add('active');

            formContainer.querySelectorAll('.tab-content').forEach(c => {
                c.classList.toggle('active', c.dataset.tab === selected);
            });
            return;
        }


        if (event.target.closest('.tabs--lang .tab-lang')) {
            const currentTab = event.target.closest('.tabs--lang .tab-lang');
            const selected = currentTab.dataset.lang;

            formContainer.querySelectorAll('.tabs--lang .tab-lang').forEach(t => t.classList.remove('active'));

            currentTab.classList.add('active');

            formContainer.querySelectorAll('.tab-lang-content').forEach(c => {
                c.classList.toggle('active', c.dataset.lang === selected);
            });
            return;
        }
    });
}