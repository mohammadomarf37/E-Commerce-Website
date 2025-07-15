// Cart Modal
document.addEventListener('DOMContentLoaded', () => {
    const checkoutBtn = document.getElementById('checkoutBtn');
    const checkoutModal = document.getElementById('checkoutModal');
    const closeBtn = document.querySelector('#checkoutModal .close');
    const loadingMsg = document.getElementById('loadingMsg');
    const checkoutbtn2 = document.getElementById('checkoutbtn2');

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
                loadingMsg.style.display = 'none';
            }
        };

    }
    if (checkoutbtn2){
        checkoutbtn2.onclick = () => {
            loadingMsg.style.display = 'block';
        }
    }
    
});
