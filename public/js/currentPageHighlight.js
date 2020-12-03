function currentPageHighlight() {
    'use strict'
    const path = window.location.pathname
    const reviewsIcon = document.getElementById('reviewsIcon')
    const usersIcon = document.getElementById('usersIcon')
    const myPageIcon = document.getElementById('myPageIcon')
    const newPostIcon = document.getElementById('newPostIcon')
    const footerMenuItems = document.querySelectorAll('footerMenuItem')
    const loginUserId = myPageIcon && document.getElementById('myPageIcon').dataset.id
    const addCurrentPage = (icon) => icon.classList.add('currentPage')

    // footerMenuItemsを配列に変換後、mapでcurrentPageを取り除く
    Array.from(footerMenuItems).map((item) => {
        item.classList.remove('currentPage')
    })

    switch (path) {
        case '/reviews':
            addCurrentPage(reviewsIcon)
            break
        case '/users':
            addCurrentPage(usersIcon)
            break
        case `/users/${loginUserId}`:
            addCurrentPage(myPageIcon)
            break
        case '/reviews/create':
            addCurrentPage(newPostIcon)
            break
        default:
            return
    }
}

window.onload = currentPageHighlight()
