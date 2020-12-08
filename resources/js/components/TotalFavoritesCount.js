import React, { useState, useEffect } from 'react'
import ReactDOM from 'react-dom'

const TotalFavoritesCount = () => {

    const [totalFavoritesCount, setTotalFavoritesCount] = useState(0)
    const currentPath = window.location.pathname

    useEffect(() => {
        const loadFavoritesCount = async () => {
            await axios
                .get(`/api${currentPath}`)
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
            いいね獲得数：{totalFavoritesCount}
        </>
    )
}
export default TotalFavoritesCount
if (document.getElementById('totalFavoritesCount')) {
    ReactDOM.render(<TotalFavoritesCount />, document.getElementById('totalFavoritesCount'))
}
