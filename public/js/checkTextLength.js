function checkTextLength(value) {
    'use strict'
    const inputtedLength = value.length
    const textLength = document.getElementById('textLength')

    // 800文字以上入力されたら入力文字数の表示を赤くする
    inputtedLength > 800 ? textLength.style.color = 'red' : textLength.style.color = '#495057'
    textLength.textContent = `${inputtedLength} / 800文字`
}
