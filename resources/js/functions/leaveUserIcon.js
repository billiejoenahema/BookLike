export const leaveUserIcon = (e) => {
    const id = e.target.dataset.id
    const userCountsDiv = document.getElementsByClassName(`review-${id}`)[0]
    // ユーザーアイコンからマウスポインターが外れたら非表示にする
    userCountsDiv.classList.add('d-none')
}
