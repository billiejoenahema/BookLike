import React, { useState, useCallback } from 'react'
import isFavorited from '../../functions/isFavorited'

const FavoriteButton = (props) => {

    const InitialFavorite = isFavorited(props.review, props.loginUser)
    const InitialCount = props.review.favorites.length
    const [favorite, setFavorite] = useState(InitialFavorite)
    const [favoriteCount, setFavoriteCount] = useState(InitialCount)
    const reviewId = props.review.id

    const toggleFavorite = useCallback(() => setFavorite((prev) => !prev), [setFavorite])

    const postFavorite = (e) => {
        const heartClassList = e.target.classList
        // アニメーションのためのクラス付与
        heartClassList.replace('text-blogDark', 'text-red')
        heartClassList.replace('far', 'fas')
        heartClassList.add('click-heart')

        // アニメーションの時間分だけ待ってから実行
        setTimeout(() => {
            toggleFavorite()
            setFavoriteCount(favoriteCount + 1)
        }, 200)

        return axios.post(`/api/add_favorite/${reviewId}`)
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

        return axios.post(`/api/remove_favorite/${reviewId}`)
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
                    <div onClick={deleteFavorite} className="p-0 border-0"><i className="fas fa-heart fa-fw text-red"></i></div >
                    : <div onClick={postFavorite} className="p-0 border-0"><i className="far fa-heart fa-fw text-blogDark"></i></div >
            }

            <p className="mb-0 text-secondary">{favoriteCount}</p>
        </>
    )
}

export default FavoriteButton
