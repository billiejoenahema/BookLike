function categorySelectValidate() {
    'use strict'
    const selectedCategory = document.getElementById('category').value
    const reviewPost = document.getElementById('reviewPost')

    // カテゴリーを選択せずに投稿ボタンを押すとアラートを出す
    selectedCategory === 'default' ? window.alert('カテゴリーを選択してください') : reviewPost.submit()
}

function checkCommentLength(value) {
    'use strict'
    const inputtedLength = value.length
    const commentLength = document.getElementById('commentLength')
    const postButton = document.getElementById('postButton')

    // 文字数チェック
    if (inputtedLength < 1 || 200 < inputtedLength) {
        commentLength.style.color = 'red'
        postButton.classList.add('disabled')
    } else {
        commentLength.style.color = '#495057'
        postButton.classList.remove('disabled')
    }

    commentLength.textContent = `${inputtedLength} / 200文字`
}

function checkTextLength(value) {
    'use strict'
    const inputtedLength = value.length
    const textLength = document.getElementById('textLength')

    // 800文字以上入力されたら入力文字数の表示を赤くする
    inputtedLength > 800 ? textLength.style.color = 'red' : textLength.style.color = '#495057'
    textLength.textContent = `${inputtedLength} / 800文字`
}

function commentValidate() {
    'use strict'
    const commentLength = document.getElementById('comment').value.length
    const commentPost = document.getElementById('commentPost')

    // 入力されたコメントが200文字を超えていたらアラートを出す
    {
        commentLength < 1 || 200 < commentLength ?
            window.alert('200文字以内で入力してください')
            : commentPost.submit()
    }
}

const flashMessage = document.getElementById('flashMessage')
flashMessage && flashMessage.classList.add('fadeout')

const onScroll = () => {
    const footerMenu = document.getElementById("footer-menu")
    const footerHeight = footerMenu.clientHeight
    let currentPosition = 0
    let lastPosition = 0

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
