const userSettings = document.querySelector(".app-user-options");
const showButton = document.querySelector(".show-button");
const containerFluid = document.querySelector(".container-fluid");
const linksContainer = document.querySelector(".links-container");
const hamburgerButton = document.querySelector(".hamburger-btn");
const hamburgerButtonContainer = document.querySelector(".hamburger-btn-container");

showButton.addEventListener("click", function () {
    userSettings.classList.toggle("hidden");
});

hamburgerButton.addEventListener("click", function () {
    linksContainer.classList.toggle("hidden");
    containerFluid.classList.toggle("margin-left-10rem");
    hamburgerButtonContainer.classList.toggle("margin-left-10rem-sub");
})