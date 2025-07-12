document.addEventListener('DOMContentLoaded', () => {
    const checkoutBtn = document.getElementById('checkoutBtn');
    const checkoutModal = document.getElementById('checkoutModal');
    const closeBtn = document.querySelector('#checkoutModal .close');

    if (checkoutBtn && checkoutModal && closeBtn) {
        checkoutBtn.onclick = () => {
            checkoutModal.style.display = 'flex';
        };

        closeBtn.onclick = () => {
            checkoutModal.style.display = 'none';
        };

        window.onclick = e => {
            if (e.target === checkoutModal) {
                checkoutModal.style.display = 'none';
            }
        };
    }
});
