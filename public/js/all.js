function categorySelectValidate() {
    'use strict'
    const selectedCategory = document.getElementById('category').value
    const reviewPost = document.getElementById('reviewPost')

    // カテゴリーを選択せずに投稿ボタンを押すとアラートを出す
    selectedCategory === 'default' ? window.alert('カテゴリーを選択してください') : reviewPost.submit()
}

function checkTextLength() {
    'use strict'
    const inputtedLength = document.getElementById('textarea').value.length
    const currentLength = document.getElementById('currentLength')
    const postButton = document.getElementById('postButton')
    const maxLength = (document.getElementById('commentPost'))
        ? 200 // コメント投稿は200文字まで
        : 800 // レビュー投稿は800文字まで

    // 800文字以上入力されたら入力文字数の表示を赤くする
    inputtedLength === 0 || maxLength < inputtedLength ? currentLength.style.color = 'red' : currentLength.style.color = '#495057'

    // 入力された文字数を随時表示
    currentLength.textContent = `${inputtedLength} / ${maxLength}文字`

    // 1~800文字なら投稿ボタンを有効化、そうでなければ無効化
    if (0 < inputtedLength && inputtedLength <= maxLength) {
        postButton.classList.remove('disabled')
        postButton.disabled = false
        return
    }
    postButton.classList.add('disabled')
    postButton.disabled = true
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
