document.addEventListener("DOMContentLoaded", function () {
    console.log("JavaScript Loaded!");
});
function toggleMenu() {
    const nav = document.querySelector("header nav");
    nav.classList.toggle("active");
}
