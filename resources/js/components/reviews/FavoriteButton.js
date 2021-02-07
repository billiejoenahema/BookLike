import React, { useState, useCallback } from 'react'
import { favoriteAnimation } from '../../functions/favoriteAnimation'
import { isFavorited } from '../../functions/isFavorited'

const FavoriteButton = (props) => {

    const InitialFavorite = isFavorited(props.review, props.loginUser)
    const InitialCount = props.review.favorites.length
    const [favorite, setFavorite] = useState(InitialFavorite)
    const [favoriteCount, setFavoriteCount] = useState(InitialCount)
    const reviewId = props.review.id

    const toggleFavorite = useCallback(() => setFavorite((prev) => !prev), [setFavorite])
    const requestFavorite = useCallback((request) => {
        return axios.post(`/api/${request}_favorite/${reviewId}`)
            .then(
                console.log('success!')
            )
            .catch(err => {
                console.log(err)
                // リクエストに失敗した時はボタンのUIを元に戻す
                toggleFavorite()
            })
    })

    const addFavorite = (e) => {
        const heartClassList = e.target.classList
        favoriteAnimation(heartClassList)
        // アニメーションの時間分だけ待ってから実行
        setTimeout(() => {
            toggleFavorite()
            setFavoriteCount(favoriteCount + 1)
        }, 200)
        requestFavorite('add')
    }
    const removeFavorite = () => {
        toggleFavorite()
        setFavoriteCount(favoriteCount - 1)
        requestFavorite('remove')
    }

    return (
        <>
            {
                favorite ?
                    <div onClick={removeFavorite} role="btn"><i className="text-red fas fa-heart fa-fw"></i></div>
                    : <div onClick={addFavorite} role="btn"><i className="text-blogDark far fa-heart fa-fw"></i></div>
            }

            <p className="mb-0 text-secondary">{favoriteCount}</p>
        </>
    )
}

export default FavoriteButton
