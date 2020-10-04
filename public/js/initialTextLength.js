window.onload = () => {
    'use strict'
    const inputtedText = document.getElementById('inputtedText')
    if (inputtedText) {
        const inputtedLength = inputtedText.value.length
        const textLength = document.getElementById('textLength')
        textLength.textContent = `${inputtedLength} / 800文字`
    }
    return
}
