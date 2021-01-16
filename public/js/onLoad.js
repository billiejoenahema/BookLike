// 投稿編集ページにおける星評価の初期値
const showRatings = (initialRatings) => {
    let ratings = initialRatings
    const starElements = document.querySelectorAll('.edit-star')

    starElements.forEach((starElement, index) => {
        // ratingの数値だけ星に色をつける
        if (index < ratings) {
            starElement.classList.replace('far', 'fas')
        }
    })
}

// スマホ用フッターメニューの現在のページのアイコンに色をつける
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

window.addEventListener('load', () => {
    //ページが読み込まれたときにratingsの初期値を取得する
    if (document.getElementById('ratings')) {
        const initialRatings = document.getElementById('ratings').dataset.ratings
        initialRatings && showRatings(initialRatings)
    }

    currentPageHighlight()
})
