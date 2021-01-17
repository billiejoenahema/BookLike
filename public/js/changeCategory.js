// レビュー投稿画面でカテゴリーを選択したときの処理
function changeCategory() {
    'use strict'
    const categoryAlert = document.getElementById('categoryAlert')
    const selectedValue = document.getElementById('categorySelector').value
    const postButton = document.getElementById('postButton')

    // カテゴリー未選択だとボタンを無効化
    if (selectedValue === 'default') {
        categoryAlert.classList.remove('text-white')
        categoryAlert.classList.add('text-danger')
        postButton.classList.add('disabled')
        postButton.disabled = true
        return
    }
    // カテゴリーを選択していればボタンを有効化
    categoryAlert.classList.remove('text-danger')
    categoryAlert.classList.add('text-white')
    postButton.classList.remove('disabled')
    postButton.disabled = false
}
