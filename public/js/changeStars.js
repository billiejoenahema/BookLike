// レビュー投稿＆編集画面で星評価を変更した時の処理
function changeStars(e) {
    'use strict'
    // element of input value
    const inputRatings = document.getElementById('inputRatings')
    // 星の表示部分
    const starElements = document.querySelectorAll('.edit-star')
    // 評価の数値
    const ratingsValue = document.querySelector('.ratings-value')
    // 選んだ星の数
    const ratings = e.id

    // 選んだ星の数をinputにセットする
    inputRatings.value = ratings
    // 評価の数値の表示を選んだ星の数に書き換える
    ratingsValue.textContent = ratings

    // 初期化処理
    starElements.forEach((starElement) => {
        // 星の数を0にする
        if (starElement.classList.contains('fas')) starElement.classList.replace('fas', 'far')
    })

    // 選んだ星の数だけ星に色をつける
    starElements.forEach((starElement, index) => {
        if (index < ratings) {
            starElement.classList.replace('far', 'fas')
        }
    })
}
