function stopVideo($elements) {
    document.querySelectorAll($elements).forEach(function(video) {
        video.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', "*")
    })
}
