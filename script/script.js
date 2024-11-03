// mobile menu toggle
const toggleButton = document.querySelector('.mobile-menu-toggle');
const mobileMenu = document.querySelector('.mobile-menu-list-items');

toggleButton.addEventListener('click', function () {
    mobileMenu.classList.toggle('active');
});


// footer copyright year

const yearSpan = document.querySelector("#year");
let date = document.lastModified;
const editDate = new Date(date);
let year = editDate.getFullYear();
yearSpan.textContent = year;