const imageModal = document.getElementById('imageModal');

if (imageModal) {
    const fileInput = imageModal.querySelector('#modalImageInput');
    const gallery = imageModal.querySelector('#modalGallery');
    const preview = imageModal.querySelector('#imagePreview');
    const previewImg = imageModal.querySelector('#previewImg');

    document.addEventListener('click', e => {
        if (e.target.closest('.image-button')) {
            imageModal.dataset.endpoint = '/admin/images';
            imageModal.classList.add('active');
        }
    });

    fileInput?.addEventListener('change', async (event) => {
        const file = event.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('image', file);

        const endpoint = '/admin/images';

        try {
            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok) {
                gallery.innerHTML = data.imageGallery;
                fileInput.value = '';
                preview.style.display = 'none';
            } else {
                alert("Error: " + (data.message || "Error desconocido"));
            }
        } catch (error) {
            alert("Fallo de conexión");
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
                const galleryContainer = document.getElementById('modalGallery');

                galleryContainer.innerHTML = '<p class="image-modal__gallery-empty">Cargando galería...</p>';

                try {
                    const response = await fetch('/admin/images-gallery-refresh');
                    const data = await response.json();

                    if (response.ok) {
                        galleryContainer.innerHTML = data.imageGallery;
                    }
                } catch (error) {
                    console.error("Error al refrescar:", error);
                    galleryContainer.innerHTML = '<p class="image-modal__gallery-empty">Error al cargar las imágenes.</p>';
                }
            }

            imageModal.querySelectorAll('.image-modal__tab, .image-modal__tab-content')
                .forEach(el => el.classList.remove('active'));

            tab.classList.add('active');
            imageModal.querySelector(`.image-modal__tab-content[data-modal-tab="${mode}"]`).classList.add('active');
            return;
        }

        const deleteBtn = target.closest('.btn-delete-image');
        if (deleteBtn) {
            const endpoint = deleteBtn.dataset.endpoint;
            if (!confirm('¿Deseas eliminar esta imagen?')) return;

            try {
                const response = await fetch(endpoint, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                const data = await response.json();
                gallery.innerHTML = data.imageGallery;
            } catch (err) {
                console.error("Error al borrar:", err);
            }
        }
    });
}