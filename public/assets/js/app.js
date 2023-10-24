function stopVideo($elements) {
    document.querySelectorAll($elements).forEach(function(video) {
        video.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', "*")
    })
}

function scrollToSection(sectionId) {
    window.scrollTo({
        // 88 - высота блока Разделы с кнопками
        top: document.querySelector(sectionId).getBoundingClientRect().top + window.scrollY - 88,
        behavior: 'smooth'
    })
}
