import React, { useState, userEffect, useCallback } from 'react'
import isFavorited from '../functions/isFavorited'

const FavoriteButton = (props) => {

    const InitialState = isFavorited(props.timeline, props.loginUser)
    const InitialCount = props.timeline.favorites.length

    const [favorite, setFavorite] = useState(InitialState)
    const [favoriteCount, setFavoriteCount] = useState(InitialCount)
    const toggleFavorite = useCallback(() => setFavorite((prev) => !prev), [setFavorite])

    const PostFavorite = () => {
        toggleFavorite()
        setFavoriteCount(favoriteCount + 1)
        console.log('PostButton Clicked!')
        const review_id = props.timeline.id

        return axios.post('http://127.0.0.1:8000/api/favorites', { review_id: review_id })
            .then(res => {
                console.log('Success!')
                console.log(review_id)

            })
            .catch(err => {
                console.log('失敗！')
            })
    }

    const DeleteFavorite = () => {
        toggleFavorite()
        setFavoriteCount(favoriteCount - 1)
        console.log('DeleteButton Clicked!')
        const favoritesArray = Array.from(props.timeline.favorites)
        const favoritesIds = favoritesArray.map(v => v.id)
        const id = favoritesIds[0]

        return axios.delete(`http://127.0.0.1:8000/api/favorites/${id}`)
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
            {
                favorite ?
                    <button onClick={DeleteFavorite} className="btn p-0 border-0" ><i className="fas fa-heart fa-fw text-danger"></i></button >
                    : <button onClick={PostFavorite} className="btn p-0 border-0" ><i className="far fa-heart fa-fw text-primary"></i></button >
            }

            <p className="mb-0 text-secondary">{favoriteCount}</p>
        </>
    )
}

export default FavoriteButton
