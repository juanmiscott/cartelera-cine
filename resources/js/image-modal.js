const imageModal = document.getElementById('imageModal');

if (imageModal) {
    const fileInput = imageModal.querySelector('#modalImageInput');
    const gallery = imageModal.querySelector('#modalGallery');
    const preview = imageModal.querySelector('#imagePreview');
    const confirmBtn = imageModal.querySelector('.confirm-button');

    function updateConfirmButton () {
        if (!gallery || !confirmBtn) return;

        const selectedItem = gallery.querySelector('.image-modal__gallery-item.selected');

        if (selectedItem) {
            confirmBtn.removeAttribute('disabled');
            confirmBtn.style.opacity = "1";
            confirmBtn.style.cursor = "pointer";
        } else {
            confirmBtn.setAttribute('disabled', 'true');
            confirmBtn.style.opacity = "0.5";
            confirmBtn.style.cursor = "not-allowed";
        }
    }

    document.addEventListener('click', e => {
        if (e.target.closest('.image-button')) {
            imageModal.classList.add('active');
            updateConfirmButton();
        }
    });

    fileInput?.addEventListener('change', async (event) => {
        const file = event.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('image', file);

        try {
            const response = await fetch('/admin/images', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });

            const data = await response.json();
            if (response.ok) {
                gallery.innerHTML = data.imageGallery;
                fileInput.value = '';
                preview.style.display = 'none';
            }
        } catch (error) {
            alert("Error de conexión");
        }
    });

    imageModal.addEventListener('click', async e => {
        const target = e.target;

        if (target === imageModal || target.closest('.cancel-button')) {
            imageModal.classList.remove('active');
            return;
        }

        const tab = target.closest('.image-modal__tab');
        if (tab) {
            const mode = tab.dataset.modalTab;

            if (mode === 'gallery') {
                gallery.innerHTML = '<p class="image-modal__gallery-empty">Cargando...</p>';
                try {
                    const response = await fetch('/admin/images-gallery-refresh');
                    const data = await response.json();
                    if (response.ok) {
                        gallery.innerHTML = data.imageGallery;
                        updateConfirmButton();
                    }
                } catch (error) {
                    console.error("Error cargando galería");
                }
            }

            imageModal.querySelectorAll('.image-modal__tab, .image-modal__tab-content')
                .forEach(el => el.classList.remove('active'));
            tab.classList.add('active');
            imageModal.querySelector(`.image-modal__tab-content[data-modal-tab="${mode}"]`).classList.add('active');
            return;
        }

        const item = target.closest('.image-modal__gallery-item');
        if (item && !target.closest('.btn-delete-image')) {
            gallery.querySelectorAll('.image-modal__gallery-item').forEach(i => i.classList.remove('selected'));
            item.classList.add('selected');
            updateConfirmButton();
            return;
        }

        const deleteBtn = target.closest('.btn-delete-image');
        if (deleteBtn) {
            e.stopPropagation();
            if (!confirm('¿Deseas eliminar la imagen?')) return;

            try {
                const response = await fetch(deleteBtn.dataset.endpoint, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                const data = await response.json();
                if (response.ok) {
                    gallery.innerHTML = data.imageGallery;
                    updateConfirmButton();
                }
            } catch (error) {
                console.error("Error al borrar");
            }
            return;
        }

        if (target.closest('.confirm-button')) {
            const selectedItem = gallery.querySelector('.image-modal__gallery-item.selected');
            if (selectedItem) {
                const filename = selectedItem.dataset.filename;
                console.log("Has elegido:", filename);
                imageModal.classList.remove('active');
            }
        }
    });
}