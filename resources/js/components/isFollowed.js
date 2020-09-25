export default function isFollowed(user, loginUser) {

    const followedArray = Array.from(user.followers)
    const userIds = followedArray.map(v => v.id)

    return userIds.includes(loginUser.id)

}
