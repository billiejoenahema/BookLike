import React, { useState, useEffect } from 'react'
import ReactDOM from 'react-dom'

const UserProfileFavoritesCount = () => {

    const [totalFavoritesCount, setTotalFavoritesCount] = useState(0)
    const currentPath = window.location.pathname
    const id = currentPath.replace(/[^0-9]/g, '')

    useEffect(() => {
        // ユーザー詳細ページ用の処理
        const loadFavoritesCount = async () => {
            await axios
                .get(`/api/users/${id}`)
                .then(res => {
                    const userReviews = res.data.userReviews
                    const total = userReviews.reduce((a, b) => a + b.favorites.length, 0)
                    setTotalFavoritesCount(total)
                })
                .catch(err => {
                    console.log(err)
                })
        }
        loadFavoritesCount()
    }, [])

    return (
        <>
            <span>いいね獲得数</span><span className="badge-pink badge-pill text-white ml-1 user-select-none">{totalFavoritesCount}</span>
        </>
    )
}
export default UserProfileFavoritesCount
if (document.getElementById('totalFavoritesCount')) {
    ReactDOM.render(<UserProfileFavoritesCount />, document.getElementById('totalFavoritesCount'))
}
