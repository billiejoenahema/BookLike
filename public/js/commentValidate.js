function commentValidate() {
    'use strict'
    const commentLength = document.getElementById('comment').value.length
    const commentPost = document.getElementById('commentPost')
    if (commentLength < 1 || 200 < commentLength) {
        window.alert('200文字以内で入力してください')
    }
    commentPost.submit()
}
