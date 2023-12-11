function stopVideo($elements) {
    document.querySelectorAll($elements).forEach(function (video) {
        video.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', "*")
    })
}

function scrollToSection(sectionId) {
    history.pushState('', '', sectionId)
    window.scrollTo({
        top: (document.querySelector(sectionId).getBoundingClientRect().top ?? 0)
            + window.scrollY
            - document.querySelector('.sticky-menu').offsetHeight ?? 0,
        behavior: 'smooth'
    })
}

window.addEventListener("load", (event) => {
    if (window.location.hash) {
        const hash = window.location.hash

        if (hash.length) {
            scrollToSection(hash)
        }
    }
});
