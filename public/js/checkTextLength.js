function checkTextLength() {
    'use strict'
    const inputtedLength = document.getElementById('textarea').value.length
    const currentLength = document.getElementById('currentLength')
    const postButton = document.getElementById('postButton')

    // 800文字以上入力されたら入力文字数の表示を赤くする
    inputtedLength === 0 || 800 < inputtedLength ? currentLength.style.color = 'red' : currentLength.style.color = '#495057'

    // 入力された文字数を随時表示
    currentLength.textContent = `${inputtedLength} / 800文字`

    // 1~800文字なら投稿ボタンを有効化、そうでなければ無効化
    if (0 < inputtedLength && inputtedLength <= 800) {
        postButton.classList.remove('disabled')
        postButton.disabled = false
        return
    }
    postButton.classList.add('disabled')
    postButton.disabled = true
}
