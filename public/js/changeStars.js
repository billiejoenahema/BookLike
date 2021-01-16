function changeStars(e) {

    // 星評価のインプット値
    const inputRatings = document.getElementById('inputRatings')
    // 星の要素をすべて取得
    const starElements = document.querySelectorAll('.edit-star')
    // 評価の数値
    const ratingsValue = document.querySelector('.ratings-value')
    // 選んだ星の数
    const ratings = e.id

    // インプット用の星評価をセット
    inputRatings.value = ratings
    // 評価の数値を選んだ星の数に書き換える
    ratingsValue.textContent = ratings

    // 初期化処理
    starElements.forEach((starElement) => {
        // 選択状態を初期化
        starElement.classList.remove('selected')
        // 星の数を0にする
        if (starElement.classList.contains('fas')) starElement.classList.replace('fas', 'far')
    })

    // 選んだ星の数だけ星に色をつける
    starElements.forEach((starElement, index) => {
        if (index < ratings) {
            starElement.classList.replace('far', 'fas')
        }
    })
    // 選択した星にselectedを付与
    e.classList.add('selected')
}
