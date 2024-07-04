// Hamburger script
document.addEventListener('DOMContentLoaded', function() {
    const hamMenu = document.querySelector('#mobileLink');
    const offScreenMenu = document.querySelector('#offScreenMenu');

    hamMenu.addEventListener('click', () => {
        hamMenu.classList.toggle('active');
        offScreenMenu.classList.toggle('active');

        document.querySelector('.m1').classList.toggle('active');
        document.querySelector('.m2').classList.toggle('active');
        document.querySelector('.m3').classList.toggle('active');
    });
});
