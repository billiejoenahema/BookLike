export default function isFollowed(user, loginUser) {
    // 対象のユーザーをログインユーザーがフォローしているかどうかを判定
    const followedArray = Array.from(user.followers)
    const userIds = followedArray.map(v => v.id)

    return userIds.includes(loginUser.id)

}
