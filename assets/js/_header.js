// Toggle to show and hide navbar menu
const navbarMenu = document.getElementById("menu");
const burgerMenu = document.getElementById("burger");

burgerMenu.addEventListener("click", () => {
    navbarMenu.classList.toggle("is-active");
    burgerMenu.classList.toggle("is-active");
});
