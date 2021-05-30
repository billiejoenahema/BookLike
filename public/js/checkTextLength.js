// コメント＆レビュー投稿のテキスト入力時の処理
function checkTextLength() {
  'use strict'
  const inputtedLength = document.getElementById('textarea').value.length
  const currentLength = document.getElementById('currentLength')
  const postButton = document.getElementById('postButton')
  const maxLength = (document.getElementById('commentPost'))
    ? 200 // コメント投稿は200文字まで
    : 800 // レビュー投稿は800文字まで
  const minLength = (document.getElementById('commentPost'))
    ? 1 // コメント投稿は1文字以上
    : 0 // レビュー投稿は0文字以上

  // 入力された文字数を随時表示
  currentLength.textContent = `${inputtedLength} / ${maxLength}文字`

  // 制限文字数の範囲を外れたら入力文字数の表示を赤くする
  if (inputtedLength < minLength || maxLength < inputtedLength) {
    currentLength.style.color = 'red'
    postButton.classList.add('disabled')
    postButton.disabled = true
    return
  }

  // 制限文字数の範囲内なら投稿ボタンを有効化
  if (minLength <= inputtedLength && inputtedLength <= maxLength) {
    currentLength.style.color = '#495057'
    postButton.classList.remove('disabled')
    postButton.disabled = false
    return
  }
}
