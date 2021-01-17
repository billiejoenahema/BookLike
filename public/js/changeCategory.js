function changeCategory() {
    const selectedValue = document.getElementById('categorySelector').value
    const postButton = document.getElementById('postButton')
    console.log(selectedValue)

    // カテゴリー未選択だとボタンを無効化
    if (selectedValue === 'default') {
        postButton.classList.add('disabled')
        postButton.disabled = true
        return
    }
    // カテゴリーを選択していればボタンを有効化
    postButton.classList.remove('disabled')
    postButton.disabled = false
}
