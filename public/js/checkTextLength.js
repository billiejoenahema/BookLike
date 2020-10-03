function checkTextLength(value) {
    'use strict'
    const inputtedLength = value.length
    const textLength = document.getElementById('textLength')

    inputtedLength > 400 ? textLength.style.color = 'red' : textLength.style.color = '#495057'

    textLength.textContent = `${inputtedLength} / 400文字`
}
