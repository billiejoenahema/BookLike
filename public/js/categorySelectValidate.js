// レビュー投稿画面でカテゴリーを選択せずにボタンを押せてしまった時の処理
function categorySelectValidate() {
  'use strict';
  const selectedCategory = document.getElementById('categorySelector').value;
  const reviewPost = document.getElementById('reviewPost');
  // カテゴリーを選択せずに投稿ボタンを押せてしまったときはアラートを出す
  selectedCategory === 'default'
    ? window.alert('カテゴリーを選択してください')
    : reviewPost.submit();
}
