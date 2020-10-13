function categorySelectValidate() {
    'use strict'
    const selectedCategory = document.getElementById('category').value
    const reviewPost = document.getElementById('reviewPost')
    if (selectedCategory === 'default') {
        window.alert('カテゴリーを選択してください')
        return
    }
    reviewPost.submit()
}
