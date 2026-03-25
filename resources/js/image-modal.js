const imageModal = document.getElementById('imageModal');

if (imageModal) {
    const fileInput = imageModal.querySelector('#modalImageInput');
    const gallery = imageModal.querySelector('#modalGallery');
    const preview = imageModal.querySelector('#imagePreview');
    const confirmBtn = imageModal.querySelector('.confirm-button');
    const metadataFields = imageModal.querySelector('#metadata-fields');
    const modalImgAlt = imageModal.querySelector('#modal-img-alt');
    const modalImgTitle = imageModal.querySelector('#modal-img-title');

    let currentUploadContainer = null;

    document.addEventListener('openImageModal', (event) => {
        currentUploadContainer = event.detail.uploadImageContainer;
        imageModal.classList.add('active');
        updateConfirmButton();
    });

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
                if (preview) preview.style.display = 'none';
            }
        } catch (error) {
            alert("Error de conexión");
        }
    });

    imageModal.addEventListener('click', async e => {
        const target = e.target;

        const item = target.closest('.image-modal__gallery-item');
        if (item && !target.closest('.btn-delete-image')) {
            gallery.querySelectorAll('.image-modal__gallery-item').forEach(i => i.classList.remove('selected'));
            item.classList.add('selected');

            if (metadataFields) metadataFields.style.display = 'block';
            updateConfirmButton();
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
                } catch (error) { console.error("Error"); }
            }
            imageModal.querySelectorAll('.image-modal__tab, .image-modal__tab-content').forEach(el => el.classList.remove('active'));
            tab.classList.add('active');
            imageModal.querySelector(`.image-modal__tab-content[data-modal-tab="${mode}"]`).classList.add('active');
            return;
        }

        const deleteBtn = target.closest('.btn-delete-image');
        if (deleteBtn) {
            e.stopPropagation();
            if (!confirm('¿Deseas eliminar la imagen permanentemente?')) return;
            try {
                const response = await fetch(deleteBtn.dataset.endpoint, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
                });
                const data = await response.json();
                if (response.ok) {
                    gallery.innerHTML = data.imageGallery;
                    updateConfirmButton();
                }
            } catch (error) { console.error("Error al borrar"); }
            return;
        }

        if (e.target.closest('.confirm-button')) {
            const selectedItem = gallery.querySelector('.image-modal__gallery-item.selected');

            if (selectedItem) {
                const src = selectedItem.querySelector('img').src;

                if (currentUploadContainer.dataset.quantity === 'single') {
                    currentUploadContainer.querySelector('.upload-image').classList.remove('hidden');
                    currentUploadContainer.querySelector('img').src = src;
                    currentUploadContainer.querySelector('img').alt = modalImgAlt.value;
                    currentUploadContainer.querySelector('img').title = modalImgTitle.value;
                } else {
                    const clone = currentUploadContainer.querySelector('.upload-image').cloneNode(true);
                    clone.classList.remove('hidden');
                    clone.querySelector('img').src = src;
                    clone.querySelector('img').alt = modalImgAlt.value;
                    clone.querySelector('img').title = modalImgTitle.value;
                    currentUploadContainer.appendChild(clone);
                }

                closeAndResetModal();
            }
        }

        if (target === imageModal || target.closest('.cancel-button') || target.closest('.close-modal')) {
            closeAndResetModal();
        }
    });

    function closeAndResetModal () {
        imageModal.classList.remove('active');
        if (metadataFields) metadataFields.style.display = 'none';
        modalImgAlt.value = '';
        modalImgTitle.value = '';
        gallery.querySelectorAll('.image-modal__gallery-item').forEach(i => i.classList.remove('selected'));
        updateConfirmButton();
    }
}