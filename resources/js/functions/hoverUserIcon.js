export const hoverUserIcon = (e) => {
    const id = e.target.dataset.id
    const userCountsDiv = document.getElementsByClassName(`review-${id}`)[0]
    // ユーザーアイコンにマウスポインターが乗ったら表示する
    userCountsDiv.classList.remove('d-none')
}
