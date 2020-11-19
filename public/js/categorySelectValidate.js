function categorySelectValidate() {
    'use strict'
    const selectedCategory = document.getElementById('category').value
    const reviewPost = document.getElementById('reviewPost')

    // カテゴリーを選択せずに投稿ボタンを押すとアラートを出す
    selectedCategory === 'default' ? window.alert('カテゴリーを選択してください') : reviewPost.submit()
}
