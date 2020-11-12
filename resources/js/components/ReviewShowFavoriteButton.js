import React, { useState, useEffect, useCallback } from 'react'
import ReactDOM from 'react-dom'
import ReactTooltip from 'react-tooltip'
import isFavorited from '../functions/isFavorited'

const ReviewShowFavoriteButton = () => {

    const [review, setReview] = useState()
    const [favorite, setFavorite] = useState(false)
    const [favoriteCount, setFavoriteCount] = useState()
    const toggleFavorite = useCallback(() => setFavorite((prev) => !prev), [setFavorite])
    const currentUrl = window.location.pathname

    useEffect(() => {
        const loadIsFavorited = async () => {
            await axios
                .get(`/api${currentUrl}`)
                .then(res => {
                    const initialCount = res.data.review.favorites.length
                    const initialFavorite = isFavorited(res.data.review, res.data.loginUser)
                    setReview(res.data.review)
                    setFavoriteCount(initialCount)
                    setFavorite(initialFavorite)
                })
                .catch(err => {
                    console.log(err)
                })
        }
        loadIsFavorited()
    }, [])

    const postFavorite = () => {
        toggleFavorite()
        setFavoriteCount(favoriteCount + 1)
        const review_id = review.id

        return axios.post(`/api/favorites`, { review_id: review_id })
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
        const favoritesArray = Array.from(review.favorites)
        const favoritesIds = favoritesArray.map(v => v.id)
        const id = favoritesIds[0]

        return axios.delete(`/api/favorites/${id}`)
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

export default ReviewShowFavoriteButton
if (document.getElementById('reviewShowFavoriteButton')) {
    ReactDOM.render(<ReviewShowFavoriteButton />, document.getElementById('reviewShowFavoriteButton'))
}
