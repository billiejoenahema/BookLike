// アカウント削除ボタン有効化のための処理
function deleteCheck() {
  'use strict';
  const deleteCheck = document.getElementById('deleteCheck');
  const deleteButton = document.getElementById('deleteButton');

  // チェック済みなら削除ボタンを有効化
  if (deleteCheck.checked) {
    deleteButton.classList.remove('disabled');
    deleteButton.disabled = false;
    return;
  }
  deleteButton.classList.add('disabled');
  deleteButton.disabled = true;
}
