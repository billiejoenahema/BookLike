function categorySelectValidate() {
    'use strict'
    const selectedCategory = document.getElementById('categorySelector').value
    const reviewPost = document.getElementById('reviewPost')

    // カテゴリーを選択せずに投稿ボタンを押すとアラートを出す
    selectedCategory === 'default' ? window.alert('カテゴリーを選択してください') : reviewPost.submit()
}

function changeCategory() {
    const selectedValue = document.getElementById('categorySelector').value
    const postButton = document.getElementById('postButton')
    console.log(selectedValue)

    // カテゴリー未選択だとボタンを無効化
    if (selectedValue === 'default') {
        postButton.classList.add('disabled')
        postButton.disabled = true
        return
    }
    // カテゴリーを選択していればボタンを有効化
    postButton.classList.remove('disabled')
    postButton.disabled = false
}

function changeStars(e) {

    // 星評価のインプット値
    const inputRatings = document.getElementById('inputRatings')
    // 星の要素をすべて取得
    const starElements = document.querySelectorAll('.edit-star')
    // 評価の数値
    const ratingsValue = document.querySelector('.ratings-value')
    // 選んだ星の数
    const ratings = e.id

    // インプット用の星評価をセット
    inputRatings.value = ratings
    // 評価の数値を選んだ星の数に書き換える
    ratingsValue.textContent = ratings

    // 初期化処理
    starElements.forEach((starElement) => {
        // 選択状態を初期化
        starElement.classList.remove('selected')
        // 星の数を0にする
        if (starElement.classList.contains('fas')) starElement.classList.replace('fas', 'far')
    })

    // 選んだ星の数だけ星に色をつける
    starElements.forEach((starElement, index) => {
        if (index < ratings) {
            starElement.classList.replace('far', 'fas')
        }
    })
    // 選択した星にselectedを付与
    e.classList.add('selected')
}

function checkInputLoginForm() {
    'use strict'

    const email = document.getElementById('email')
    const password = document.getElementById('password')
    const login = document.getElementById('login')

    // emailとpasswordが入力されたらログインボタンを有効化する
    if ((email.value.indexOf('@') != -1) && password.value.length > 7) {
        login.classList.remove('disabled')
        login.disabled = false
    } else if (login.classList.contains('disabled') && login.disabled === false) {
        login.classList.add('disabled')
        login.disabled = true
    }
}

function checkTextLength() {
    'use strict'
    const inputtedLength = document.getElementById('textarea').value.length
    const currentLength = document.getElementById('currentLength')
    const postButton = document.getElementById('postButton')
    const maxLength = (document.getElementById('commentPost'))
        ? 200 // コメント投稿は200文字まで
        : 800 // レビュー投稿は800文字まで
    const minLength = (document.getElementById('commentPost'))
        ? 1 // コメント投稿は1文字以上
        : 0 // レビュー投稿は0文字以上

    // 入力された文字数を随時表示
    currentLength.textContent = `${inputtedLength} / ${maxLength}文字`

    // 制限文字数の範囲を外れたら入力文字数の表示を赤くする
    if (inputtedLength < minLength || maxLength < inputtedLength) {
        currentLength.style.color = 'red'
        postButton.classList.add('disabled')
        postButton.disabled = true
        return
    }

    // 制限文字数の範囲内なら投稿ボタンを有効化
    if (minLength <= inputtedLength && inputtedLength <= maxLength) {
        currentLength.style.color = '#495057'
        postButton.classList.remove('disabled')
        postButton.disabled = false
        return
    }
}

function deleteCheck() {
    'use strict'
    const deleteCheck = document.getElementById('deleteCheck')
    const deleteButton = document.getElementById('deleteButton')

    // チェック済みなら削除ボタンを有効化
    if (deleteCheck.checked) {
        deleteButton.classList.remove('disabled')
        deleteButton.disabled = false
        return
    }
    deleteButton.classList.add('disabled')
    deleteButton.disabled = true
}

const card = document.getElementById('userProfileCard')
const editButton = document.getElementById('editButton')

if (card) {

    // カードをマウスホバーしたら編集ボタンを表示する
    card.addEventListener('mouseover', () => {
        editButton.classList.remove('text-white')
        editButton.classList.add('text-secondary')
    })

    // カードからマウスが外れたら非表示にする
    card.addEventListener('mouseout', () => {
        editButton.classList.remove('text-secondary')
        editButton.classList.add('text-white')
    })
}



const flashMessage = document.getElementById('flashMessage')
flashMessage && flashMessage.classList.add('fadeout')

let currentPosition = 0
let lastPosition = 0

const onScroll = () => {
    const footerMenu = document.getElementById("footer-menu")
    const footerHeight = footerMenu.clientHeight

    // 下にスクロールしたらfooterMenuを非表示に
    if (currentPosition > footerHeight && currentPosition > lastPosition) {
        footerMenu.classList.add('footer-menu-hidden')
    }
    // 上にスクロールしたらfooterMenuを再表示
    if (currentPosition < footerHeight || currentPosition < lastPosition) {
        footerMenu.classList.remove('footer-menu-hidden')
    }
    // lastPositionを更新
    lastPosition = currentPosition
}

window.addEventListener("scroll", () => {
    // スクロールするごとにcurrentPositionを更新
    currentPosition = window.scrollY

    onScroll()
})

function formatDate(createdAt, format) {

    const date = new Date(createdAt.replace(/-/g, '/'))
    format = format.replace(/yyyy/g, date.getFullYear())
    format = format.replace(/MM/g, ('0' + (date.getMonth() + 1)).slice(-2))
    format = format.replace(/dd/g, ('0' + date.getDate()).slice(-2))

    return format
}


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

const scrollTop = (e) => {
    'use strict'
    e.preventDefault()
    // スクロール量を取得
    const scrollAmount = document.body.scrollTop || document.documentElement.scrollTop

    if (scrollAmount) {
        scrollTo(0, scrollAmount /= 1.06)
    }
    return
}

function selectItem(e) {
    // 投稿する書籍選択画面でクリックした書籍を選択状態にする
    const elements = document.querySelectorAll('.search-item')
    elements.forEach((element) => {
        element.style.border = "solid 1px rgba(0, 0, 0, 0.125)"
        element.classList.remove('selected')
    })

    e.classList.add('selected')
    e.style.border = "solid 3px #7092be"
    document.getElementById('asin').value = e.id

    const confirmButton = document.getElementById('confirmButton')
    confirmButton.classList.remove('disabled')
    confirmButton.disabled = false
    confirmButton.classList.add('active')
}
