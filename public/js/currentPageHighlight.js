function currentPageHighlight() {
    'use strict'
    const path = window.location.pathname
    const reviewsIcon = document.getElementById('reviewsIcon')
    const usersIcon = document.getElementById('usersIcon')
    const usersShowIcon = document.getElementById('usersShowIcon')
    const reviewsCreateIcon = document.getElementById('reviewsCreateIcon')
    const footerMenuItems = document.querySelectorAll('footerMenuItem')
    const addCurrentPage = (icon) => icon.classList.add('currentPage')

    // footerMenuItemsを配列にしてからmapでcurrentPageを取り除く
    Array.from(footerMenuItems).map((item) => {
        item.classList.remove('currentPage')
    })

    switch (true) {
        case path === '/reviews':
            addCurrentPage(reviewsIcon)
            break
        case path === '/users':
            addCurrentPage(usersIcon)
            break
        case path.includes('/users/'):
            addCurrentPage(usersShowIcon)
            break
        case path === '/reviews/create':
            addCurrentPage(reviewsCreateIcon)
            break
        default:
            return
    }
}

window.onload = currentPageHighlight()
