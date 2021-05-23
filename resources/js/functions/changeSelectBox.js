// カテゴリー選択時にセレクトボックスを操作する
export const changeSelectBox = (selectedCategory) => {
  const selectedOption = document.getElementById('categorySelector').options
  for (const option of selectedOption) {
    option.selected = false
    if (option.value === selectedCategory) {
      option.selected = true
    }
  }
}
