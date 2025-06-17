$(document).ready(function () {
    const navbar = $('.main-navbar')
    let lastScrollTop = 0
    $(window).scroll(e => {
        const st = $(this).scrollTop()
        const currentScroll = window.scrollY

        if (st > 5) {
            navbar.removeClass('show').addClass('hide')
        } else {
            if (st + $(window).height() < $(document).height()) {
                navbar.removeClass('hide').addClass('show')
            }
        }


        if (st > 300 && currentScroll < lastScrollTop) {
            navbar.addClass('sticky-top').addClass('show').removeClass('hide')
        } else {
            navbar.removeClass('sticky-top')
        }

        lastScrollTop = currentScroll
    })
})
