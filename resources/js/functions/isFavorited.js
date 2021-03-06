export const isFavorited = (review, loginUser) => {
  'use strict'
  // 対象の投稿にログインユーザーがいいねしているかどうかを判定
  const favoritesArray = Array.from(review.favorites)
  const userIds = favoritesArray.map(v => v.user_id)
  return userIds.includes(loginUser.id)
}
