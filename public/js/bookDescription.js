function bookDescription(e) {
    'use strict'

    const bookShelf = document.querySelectorAll('.my-book')
    const selectedBook = document.getElementById(`description_${e.id}`)
    const descriptionList = document.querySelectorAll('.description')

    // 本の選択状態をリセット
    const removeSelected = () => {
        bookShelf.forEach((book) => {
            book.style.border = "none"
            book.classList.contains('selected') && book.classList.remove('selected')
        })
    }

    // 本の説明を非表示にする
    const hiddenDescriptions = () => {
        descriptionList.forEach((description) => {
            !(description.classList.contains('d-none')) && description.classList.add('d-none')
        })
    }

    // すでに選択状態の本をクリックしたら初期状態に戻す
    if (e.classList.contains('selected')) {
        removeSelected()
        hiddenDescriptions()
        return
    }

    removeSelected()
    hiddenDescriptions()
    // 選択した本にボーダーをつける
    e.style.border = "solid 3px #7092be"
    e.classList.add('selected')
    // 選択した本の説明を表示
    selectedBook.classList.remove('d-none')
}
