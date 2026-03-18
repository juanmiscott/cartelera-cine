<div id="imageModal" class="overlay">
    <div class="image-modal">
        <h3 class="title">Imagenes</h3>

        <div class="image-modal__tabs">
            <button type="button" class="image-modal__tab active" data-modal-tab="upload">Subir imagen</button>
            <button type="button" class="image-modal__tab" data-modal-tab="gallery">Galería</button>
        </div>

        <div class="image-modal__tab-content active" data-modal-tab="upload">
            <div class="image-modal__upload-area">
                <label for="modalImageInput" class="image-modal__upload-label">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M9,16V10H5L12,3L19,10H15V16H9M5,20V18H19V20H5Z"/>
                    </svg>
                    <span>Seleccionar archivo</span>
                    <input type="file" id="modalImageInput" name="image" accept="image/*">
                </label>
                <div id="imagePreview" class="image-modal__preview" style="display: none;">
                    <img id="previewImg" src="" alt="Vista previa">
                </div>
            </div>
        </div>

        <div class="image-modal__tab-content" data-modal-tab="gallery">
            <div class="image-modal__gallery" id="modalGallery">
                <p class="image-modal__gallery-empty">No hay imágenes disponibles.</p>
            </div>

            <div class="actions">
                <button type="button" class="cancel-button">Cancelar</button>
                <button type="button" class="confirm-button" disabled>Seleccionar</button>
            </div>
        </div>
    </div>
</div>