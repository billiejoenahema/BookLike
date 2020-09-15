import React, { useState, useCallback } from 'react'

const FavoriteButton = (props) => {

    const InitialState = favorited(props.timeline, props.loginUser)
    const InitialCount = props.timeline.favorites.length

    function favorited(timeline, loginUser) {
        const favoritesArray = Array.from(timeline.favorites)
        const userIds = favoritesArray.map(v => v.user_id)
        return userIds.includes(loginUser.id)
    }

    const [favorite, setFavorite] = useState(InitialState)
    const [count, setCount] = useState(InitialCount)
    const toggleFavorite = useCallback(() => setFavorite((prev) => !prev), [setFavorite])


    function countUp() {
        setCount(count + 1)
    }

    function countDown() {
        setCount(count - 1)
    }

    const PostFavoriteButton = () => {
        toggleFavorite()
        countUp()
        console.log('PostButton Clicked!')
        const review_id = props.timeline.id


        return axios.post('api/favorites', { review_id: review_id })
            .then(res => {
                console.log('Success!')
                console.log(review_id)

            })
            .catch(err => {
                console.log('失敗！')
            })
    }

    const DeleteFavoriteButton = () => {
        toggleFavorite()
        countDown()
        console.log('DeleteButton Clicked!')
        const favoritesArray = Array.from(props.timeline.favorites)
        const favoritesIds = favoritesArray.map(v => v.id)
        const id = favoritesIds[0]

        return axios.delete(`api/favorites/${id}`)
            .then(res => {
                console.log('Success!')
                console.log(res.data)
            })
            .catch(err => {
                console.log('失敗！')
            })
    }

    return (
        <>
            <button onClick={favorite ? DeleteFavoriteButton : PostFavoriteButton} className="btn p-0 border-0" data-tip="いいねボタン" >
                <i className={favorite ? "fas fa-heart fa-fw text-danger" : "far fa-heart fa-fw text-primary"}></i></button >
            <p className="mb-0 text-secondary">{count}</p>
        </>
    )
}

export default FavoriteButton
