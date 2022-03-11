(function () {
    ("use strict");
    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim();
        if (all) {
            return [...document.querySelectorAll(el)];
        } else {
            return document.querySelector(el);
        }
    };

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        let selectEl = select(el, all);
        if (selectEl) {
            if (all) {
                selectEl.forEach((e) => e.addEventListener(type, listener));
            } else {
                selectEl.addEventListener(type, listener);
            }
        }
    };

    /**
     * Easy on scroll event listener
     */
    const onscroll = (el, listener) => {
        el.addEventListener("scroll", listener);
    };

    /**
     * Preloader
     */
    let preloader = select(".preloader-main");
    let div = select(".preloader-wapper");

    if (preloader) {
        window.addEventListener("load", () => {
            setTimeout(function () {
                div.classList.add("loaded");
            }, 2000);
            setTimeout(function () {
                preloader.remove();
                $(document.body).removeClass("unscrollable");
                // $(document.body).niceScroll();
                aos_init();
            }, 3000);
        });
    }

    /**
     * Scrolls to an element with header offset
     */
    const scrollto = (el) => {
        let header = select("#header");
        let offset = header.offsetHeight;

        if (!header.classList.contains("header-scrolled")) {
            offset -= 16;
        }

        let elementPos = select(el).offsetTop;
        window.scrollTo({
            top: elementPos - offset,
            behavior: "smooth",
        });
    };

    /**
     * Progress Bar
     */
    let height =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;

    window.addEventListener("scroll", () => {
        let scrollTop =
            document.body.scrollTop || document.documentElement.scrollTop;
        document.querySelectorAll(".scroll-progress").forEach((el) => {
            el.style.width = `${(scrollTop / height) * 100}%`;
        });
    });

    /**
     * Toggle .header-scrolled class to #header when page is scrolled
     * Fixed navbar
     * Change logo
     */
    let selectHeader = select("#header");

    if (selectHeader) {
        url = window.location.pathname.split("/")[1].toLowerCase();
        white = select("#logo-white");
        black = select("#logo-black");

        if (url == "artikel" || url == "preview_article") {
            white.style.display = "none";
            black.style.display = "block";
            selectHeader.classList.add("header-scrolled");
        } else {
            const headerScrolled = () => {
                if (window.scrollY > 100) {
                    selectHeader.classList.add("header-scrolled");
                    white.style.display = "none";
                    black.style.display = "block";
                } else {
                    selectHeader.classList.remove("header-scrolled");
                    black.style.display = "none";
                    white.style.display = "block";
                }
            };

            window.addEventListener("load", headerScrolled);
            onscroll(document, headerScrolled);
        }
    }

    let prevScrollpos = window.pageYOffset;

    window.onscroll = function () {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            selectHeader.style.top = "0";
        } else {
            selectHeader.style.top = "-6rem";
        }
        prevScrollpos = currentScrollPos;
    };

    on("click", ".btn-close", function () {
        let btn_close = select(".btn-close");
        $("#search-title").val("");
        $(".suggestion-box").empty();
        btn_close.style.opacity = 0;
    });

    document.addEventListener(
        "click",
        function (event) {
            suggestion = select(".suggestion-box");
            search = select("#search-title");
            // If user either clicks X button OR clicks outside the modal window, then close modal by calling closeModal()
            if (
                event.target.matches(".btn-close") ||
                !event.target.closest(".input-field")
            ) {
                if (suggestion) {
                    suggestion.style.opacity = 0;
                    search.style.borderRadius = "34px";
                }
            }
        },
        false
    );

    /**
     * Back to top button
     */
    let backtotop = select(".back-to-top");
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add("active");
            } else {
                backtotop.classList.remove("active");
            }
        };
        window.addEventListener("load", toggleBacktotop);
        onscroll(document, toggleBacktotop);
    }

    on("click", ".back-to-top", function (e) {
        if (select(this.hash)) {
            e.preventDefault();
            scrollto(this.hash);
        }
    });

    // We listen to the resize event
    window.addEventListener("resize", () => {
        // We execute the same script as before
        let vh = window.innerHeight * 0.01;
        document.documentElement.style.setProperty("--vh", `${vh}px`);
    });

    /**
     * Mobile nav toggle
     */
    on("click", ".mobile-nav-toggle", function (e) {
        select("#navbar").classList.toggle("navbar-mobile");
        this.classList.toggle("bi-list");
        this.classList.toggle("bi-x");
    });

    /**
     * Mobile nav dropdowns activate
     */
    on(
        "click",
        ".navbar .dropdown > a",
        function (e) {
            if (select("#navbar").classList.contains("navbar-mobile")) {
                e.preventDefault();
                this.nextElementSibling.classList.toggle("dropdown-active");
            }
        },
        true
    );

    /**
     * Scroll with offset on links with a class name .scrollto
     */
    on(
        "click",
        ".scrollto",
        function (e) {
            if (select(this.hash)) {
                e.preventDefault();

                let navbar = select("#navbar");
                if (navbar.classList.contains("navbar-mobile")) {
                    navbar.classList.remove("navbar-mobile");
                    let navbarToggle = select(".mobile-nav-toggle");
                    navbarToggle.classList.toggle("bi-list");
                    navbarToggle.classList.toggle("bi-x");
                }
                scrollto(this.hash);
            }
        },
        true
    );

    /**
     * Scroll with offset on page load with hash links in the url
     */
    window.addEventListener("load", () => {
        if (window.location.hash) {
            if (select(window.location.hash)) {
                scrollto(window.location.hash);
            }
        }
    });

    //bs modal hide instead of redirect to previous url on phone
    $(".modal").on("shown.bs.modal", function () {
        // any time a modal is shown
        var urlReplace = "#" + $(this).attr("id"); // make the hash the id of the modal shown
        history.pushState(null, null, urlReplace); // push state that hash into the url
    });

    // If a push state has previously happened and the back button is clicked, hide any modals.
    $(window).on("popstate", function () {
        $(".modal").modal("hide");
    });

    /**
     * Image Lightbox
     */
    const Lightbox = GLightbox({
        selector: ".lightbox",
    });

    /**
     * Porfolio isotope and filter
     */
    window.addEventListener("load", () => {
        let itemContainer = select(".item-container");
        if (itemContainer) {
            let isotope = new Isotope(itemContainer, {
                itemSelector: ".grid-item",
            });

            let itemFilters = select("#item-filter li", true);

            on(
                "click",
                "#item-filter li",
                function (e) {
                    e.preventDefault();
                    itemFilters.forEach(function (el) {
                        el.classList.remove("filter-active");
                    });
                    this.classList.add("filter-active");

                    isotope.arrange({
                        filter: this.getAttribute("data-filter"),
                    });
                },
                true
            );
        }
    });

    var $links = $(".tag-wrap a");
    $links.click(function () {
        $links.removeClass("active_tag");
        $(this).addClass("active_tag");
    });

    function aos_init() {
        AOS.init({
            duration: 1000,
            easing: "ease-in-out",
            once: true,
            mirror: false,
        });
    }

    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    let reqURL =
        "https://api.rss2json.com/v1/api.json?rss_url=" +
        encodeURIComponent(
            "https://www.youtube.com/feeds/videos.xml?channel_id="
        );
    let account_id = "UCmekw_c_zaeYQFNJioPmf8g";
    let api_key = "cz5xxmdsj7l93zyqu68wzchoggsq4iipb3yldbuy";

    function loadVideo(video_frame, thumbnail, title) {
        $.getJSON(reqURL + account_id + "&api_key=" + api_key, function (data) {
            let videoNumber = video_frame.getAttribute("vnum")
                ? Number(video_frame.getAttribute("vnum"))
                : 0;

            let link = data.items[videoNumber].link;
            let img_thumbnail = data.items[videoNumber].thumbnail;
            let video_title = data.items[videoNumber].title.replace(
                /&quot;/g,
                '"'
            );

            id = link.substr(link.indexOf("=") + 1);
            video_frame.setAttribute("href", "https://youtube.com/embed/" + id);

            thumbnail.setAttribute("src", img_thumbnail);

            thumbnail.addEventListener("error", function (event) {
                event.target.src = "assets/img/web/video-placeholder.jpg";
                event.onerror = null;
            });

            title.textContent += video_title;

            video_frame.classList.add("lightbox-video");
        });
    }

    let iframes = document.getElementsByClassName("latestVideo");
    let thumbnail = document.getElementsByClassName("video-thumbnail");
    let title = document.getElementsByClassName("video-title");

    function injectYoutubeData() {
        for (let i = 0, len = iframes.length; i < len; i++) {
            loadVideo(iframes[i], thumbnail[i], title[i]);
        }
    }

    function declareVideoLightbox() {
        let lightboxVideo = GLightbox({
            selector: ".lightbox-video",
            zoomable: false,
            draggable: false,
            videosWidth: "1280px",
            plyr: {
                config: {
                    ratio: "16:9", // or '4:3'
                    muted: false,
                    hideControls: true,
                    youtube: {
                        noCookie: true,
                        rel: 0,
                        showinfo: 0,
                        iv_load_policy: 3,
                    },
                },
            },
        });
    }

    $(document).ready(function () {
        injectYoutubeData();
        setTimeout(function () {
            declareVideoLightbox();
        }, 1000);
    });

    $(window)
        .on("resize", function () {
            $(".latestVideo").height($(".latestVideo").width() / 1.8);
        })
        .resize();
})();
