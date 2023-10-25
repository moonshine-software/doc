function stopVideo($elements) {
    document.querySelectorAll($elements).forEach(function (video) {
        video.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', "*")
    })
}

function scrollToSection(sectionId) {
    window.scrollTo({
        top: document.querySelector(sectionId).getBoundingClientRect().top
            + window.scrollY
            - document.querySelector('.sticky-menu').offsetHeight ?? 0,
        behavior: 'smooth'
    })
}
