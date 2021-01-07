import React, { useState, useCallback } from 'react'
import isFavorited from '../functions/isFavorited'

const FavoriteButton = (props) => {

    const InitialFavorite = isFavorited(props.timeline, props.loginUser)
    const InitialCount = props.timeline.favorites.length
    const [favorite, setFavorite] = useState(InitialFavorite)
    const [favoriteCount, setFavoriteCount] = useState(InitialCount)
    const id = props.timeline.id

    const toggleFavorite = useCallback(() => setFavorite((prev) => !prev), [setFavorite])

    const postFavorite = (e) => {
        e.preventDefault()
        toggleFavorite()
        setFavoriteCount(favoriteCount + 1)

        return axios.post(`/api/add_favorite/${id}`)
            .then(
                console.log('success!')
            )
            .catch(err => {
                console.log(err)
            })
    }

    const deleteFavorite = (e) => {
        e.preventDefault()
        toggleFavorite()
        setFavoriteCount(favoriteCount - 1)

        return axios.post(`/api/remove_favorite/${id}`)
            .then(
                console.log('success!')
            )
            .catch(err => {
                console.log(err)
            })
    }

    return (
        <>
            {
                favorite ?
                    <button onClick={deleteFavorite} className="btn p-0 border-0"><i className="fas fa-heart fa-fw text-red"></i></button >
                    : <button onClick={postFavorite} className="btn p-0 border-0"><i className="far fa-heart fa-fw text-blog"></i></button >
            }

            <p className="mb-0 text-secondary">{favoriteCount}</p>
        </>
    )
}

export default FavoriteButton
