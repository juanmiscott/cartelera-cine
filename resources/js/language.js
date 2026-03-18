document.addEventListener('DOMContentLoaded', () => {
    const languageSelect = document.querySelector('#language');

    if (languageSelect) {
        languageSelect.addEventListener('change', async (event) => {
            const formData = new FormData();
            formData.append('language', event.target.value);
            formData.append('path', window.location.href);

            const response = await fetch('/language', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData,
            });

            const result = await response.json();
            window.location.href = result.url;
        });
    }
});