// JavaScript to handle menu icon click for mobile view
const menuIcon = document.getElementById('menu-icon');
const navlist = document.querySelector('.navlist');

menuIcon.addEventListener('click', () => {
    navlist.classList.toggle('active');
});

// JavaScript to handle sticky header on scroll
window.addEventListener('scroll', () => {
    const header = document.querySelector('header');
    header.classList.toggle('sticky', window.scrollY > 120);
});
