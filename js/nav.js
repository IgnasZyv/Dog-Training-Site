// Navigation controls for the mobile view (Not all pages are styled to support mobile view.)
const mobileBtn = document.getElementById("menu-cta");
const nav = document.querySelector("nav");
const mobileBtnExit = document.getElementById("menu-exit");


mobileBtn.addEventListener("click", () =>  {
    nav.classList.add("menu-btn");
})

mobileBtnExit.addEventListener("click", () =>  {
    nav.classList.remove("menu-btn");
})