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
