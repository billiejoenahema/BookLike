export const favoriteAnimation = (heartClassList) => {
  // アニメーションのためのクラス付与
  heartClassList.replace('text-blogDark', 'text-red')
  heartClassList.replace('far', 'fas')
  heartClassList.add('click-heart')
}
