export default function isFavorited(timeline, loginUser) {
    // 対象の投稿にログインユーザーがいいねしているかどうかを判定
    const favoritesArray = Array.from(timeline.favorites)
    const userIds = favoritesArray.map(v => v.user_id)

    return userIds.includes(loginUser.id)
}
