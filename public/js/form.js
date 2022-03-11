const select = (el, all = false) => {
    el = el.trim();
    if (all) {
        return [...document.querySelectorAll(el)];
    } else {
        return document.querySelector(el);
    }
};

let preloader = select(".preloader-main");
let div = select(".preloader-wapper");

if (preloader) {
    window.addEventListener("load", () => {
        setTimeout(function () {
            div.classList.add("loaded");
        }, 2000);
        setTimeout(function () {
            preloader.remove();
        }, 5000);
    });
}

const body = select("body");
const modal = select(".loginModal");
const closeButton = select(".close-button");
const scrollDown = select(".scroll-down");
let isOpened = false;

const openModal = () => {
    modal.classList.remove("is-closed");
    modal.classList.add("is-open");
    body.style.overflow = "hidden";
};

const closeModal = () => {
    modal.classList.add("is-closed");
    modal.classList.remove("is-open");
    body.style.overflow = "initial";
    isOpened = false;
    scrollDown.style.opacity = 1;

    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
};

window.addEventListener("scroll", () => {
    if (window.scrollY > window.innerHeight / 3 && !isOpened) {
        isOpened = true;
        scrollDown.style.opacity = 0;
        openModal();
    }
});

closeButton.addEventListener("click", closeModal);

document.onkeydown = (evt) => {
    evt = evt || window.event;
    evt.keyCode === 27 ? closeModal() : false;
};
