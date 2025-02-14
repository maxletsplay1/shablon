document.addEventListener("DOMContentLoaded", function () {
    const burger = document.getElementById("burger-menu");
    const menu = document.getElementById("additional-menu");

    burger.addEventListener("click", function () {
        menu.classList.toggle("active");
        burger.classList.toggle("active");
    });
});
