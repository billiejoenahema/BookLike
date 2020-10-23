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

function checkTextLength(value) {
    'use strict'
    const inputtedLength = value.length
    const textLength = document.getElementById('textLength')

    inputtedLength > 800 ? textLength.style.color = 'red' : textLength.style.color = '#495057'

    textLength.textContent = `${inputtedLength} / 800文字`
}

function commentValidate() {
    'use strict'
    const commentLength = document.getElementById('comment').value.length
    const commentPost = document.getElementById('commentPost')
    if (commentLength < 1 || 200 < commentLength) {
        window.alert('200文字以内で入力してください')
        return
    }
    commentPost.submit()
}

window.onload = () => {
    const select = document.getElementById('editCategory')
    if (select) {
        const options = select.options
        const category = document.getElementById('editCategory').dataset.category

        for (let i = 0; i < options.length; i++) {
            if (options[i].value === category) {
                options[i].selected = true;
                break;
            }
        }
    }
}

const flashMessage = document.getElementById('flashMessage')
flashMessage && flashMessage.classList.add('fadeout')

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

const scrollTop = (e) => {
    'use strict'
    e.preventDefault()
    const y = document.body.scrollTop || document.documentElement.scrollTop
    if (y) {
        scrollTo(0, y /= 1.06)
    }
    return
}

function selectItem(e) {
    const elements = document.querySelectorAll('.search-item')
    elements.forEach((element) => {
        element.style.border = "solid 1px rgba(0, 0, 0, 0.125)"
        element.classList.remove('selected')
    })

    e.classList.add('selected')
    e.style.border = "solid 3px #7092be"
    document.getElementById('asin').value = e.id

    const confirmButton = document.getElementById('confirmButton')
    confirmButton.classList.remove('disabled')
    confirmButton.disabled = false
    confirmButton.classList.add('active')
}
