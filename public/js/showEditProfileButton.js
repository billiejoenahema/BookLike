// ユーザープロフィール編集ボタンの表示/非表示
const card = document.getElementById('userProfileCard')
const editButton = document.getElementById('editButton')

if (card) {
  // カードをマウスホバーしたら編集ボタンを表示する
  card.addEventListener('mouseover', () => {
    editButton.classList.remove('text-white')
    editButton.classList.add('text-secondary')
  })
  // カードからマウスが外れたら非表示にする
  card.addEventListener('mouseout', () => {
    editButton.classList.remove('text-secondary')
    editButton.classList.add('text-white')
  })
}
