document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById('filterModal');
    if (!modal) return;

    const cancelBtn = modal.querySelector('.cancel-button');
    const applyBtn = modal.querySelector('.apply-button');
    const form = modal.querySelector('#filterForm');

    if (cancelBtn) {
        cancelBtn.addEventListener('click', () => {
            modal.classList.remove('active');
            form?.reset();
        });
    }

    if (applyBtn) {
        applyBtn.addEventListener('click', () => {

            const formData = new FormData(form);
            const params = new URLSearchParams();

            for (const [key, value] of formData.entries()) {
                if (value) params.append(key, value);
            }

            modal.classList.remove('active');

            const query = params.toString();
            window.location.href = query ? `?${query}` : window.location.pathname;
        });
    }

    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.classList.remove('active');
        }
    });

});
