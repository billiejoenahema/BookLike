export default function isFollowed(user, loginUser) {

    if (user.followers) {
        const followedArray = Array.from(user.followers)
        const userIds = followedArray.map(v => v.id)
        return userIds.includes(loginUser.id)
    }
    const followedArray = Array.from(user.pivot)
    const userIds = followedArray.map(v => v.id)
    return userIds.includes(loginUser.id)
}
