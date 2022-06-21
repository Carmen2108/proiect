const toggleBtn = document.querySelector('#toggleBtn');
const balanceform = document.querySelector('.balance-form');

toggleBtn.addEventListener('click', () => {
    if (balanceform.style.display === 'none') {
        balanceform.style.display = 'block';
    }
    else {
        balanceform.style.display = 'none';
    }
});