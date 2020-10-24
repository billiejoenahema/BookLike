import React, { useState, useCallback } from 'react'
import ReactTooltip from 'react-tooltip'
import isFavorited from '../functions/isFavorited'

const FavoriteButton = (props) => {

    const InitialFavorite = isFavorited(props.timeline, props.loginUser)
    const InitialCount = props.timeline.favorites.length

    const [favorite, setFavorite] = useState(InitialFavorite)
    const [favoriteCount, setFavoriteCount] = useState(InitialCount)
    const toggleFavorite = useCallback(() => setFavorite((prev) => !prev), [setFavorite])

    const postFavorite = () => {
        toggleFavorite()
        setFavoriteCount(favoriteCount + 1)
        const review_id = props.timeline.id

        return axios.post('http://127.0.0.1:8000/api/favorites', { review_id: review_id })
            .then(
                console.log('success!')
            )
            .catch(err => {
                console.log(err)
            })
    }

    const deleteFavorite = () => {
        toggleFavorite()
        setFavoriteCount(favoriteCount - 1)
        const favoritesArray = Array.from(props.timeline.favorites)
        const favoritesIds = favoritesArray.map(v => v.id)
        const id = favoritesIds[0]

        return axios.delete(`http://127.0.0.1:8000/api/favorites/${id}`)
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
                    <button onClick={deleteFavorite} className="btn p-0 border-0" data-tip="いいね"><i className="fas fa-heart fa-fw text-red"></i><ReactTooltip effect="float" type="info" place="top" /></button >
                    : <button onClick={postFavorite} className="btn p-0 border-0" data-tip="いいね"><i className="far fa-heart fa-fw text-blog"></i><ReactTooltip effect="float" type="info" place="top" /></button >
            }

            <p className="mb-0 text-secondary">{favoriteCount}</p>
        </>
    )
}

export default FavoriteButton
