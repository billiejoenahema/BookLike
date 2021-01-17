// 投稿する書籍を選択した時の処理
function selectItem(e) {
    'use strict'
    // 投稿する書籍選択画面でクリックした書籍を選択状態にする
    const elements = document.querySelectorAll('.search-item')
    elements.forEach((element) => {
        element.style.border = "solid 1px rgba(0, 0, 0, 0.125)"
        element.classList.remove('selected')
    })

    // 選択した書籍をインプットするための処理
    e.classList.add('selected')
    e.style.border = "solid 3px #7092be"
    document.getElementById('asin').value = e.id

    // 確定ボタンを有効化
    const confirmButton = document.getElementById('confirmButton')
    confirmButton.classList.remove('disabled')
    confirmButton.disabled = false
    confirmButton.classList.add('active')
}
