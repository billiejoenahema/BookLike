export default function isFavorited(timeline, loginUser) {
    const favoritesArray = Array.from(timeline.favorites)
    const userIds = favoritesArray.map(v => v.user_id)
    return userIds.includes(loginUser.id)
}
