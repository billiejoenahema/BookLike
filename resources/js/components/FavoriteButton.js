import React, { useState, useEffect, useCallback } from "react"
import ReactTooltip from 'react-tooltip'
import { set } from 'lodash'

const FavoriteButton = (props) => {

    const InitialState = Favorited(props.timeline, props.loginUser)

    const [favorite, setFavorite] = useState({ isFavorite: InitialState, count: props.timeline.favorites.length })
    console.log(favorite.isFavorite)

    function Favorited(timeline, loginUser) {
        const favoritesArray = Array.from(timeline.favorites)
        const userIds = favoritesArray.map(v => v.user_id)
        return userIds.includes(loginUser.id)
    }

    const toggleFavorite = React.useCallback(() => setFavorite((prev) => !prev), [setFavorite])

    const PostFavoriteButton = (e) => {
        e.preventDefault()
        console.log('PostButton Clicked!')
        const review_id = props.timeline.id
        console.log(review_id)

        return axios.post('api/favorites', { review_id: review_id })
            .then(res => {
                console.log('Success!')
            })
            .catch(err => {
                console.log('失敗！')
            })
    }

    const DeleteFavoriteButton = (e) => {
        e.preventDefault()
        console.log('DeleteButton Clicked!')
        const favoritesArray = Array.from(props.timeline.favorites)
        console.log(props.timeline.favorites)
        const favoritesIds = favoritesArray.map(v => v.id)
        const id = favoritesIds[0]

        return axios.delete(`api/favorites/${id}`)
            .then(res => {
                console.log('Success!')
            })
            .catch(err => {
                console.log('失敗！')
            })
    }

    return (
        <>
            {
                favorite.isFavorite ?
                    (<button onClick={DeleteFavoriteButton} className="btn p-0 border-0" data-tip="いいねボタン" >
                        <ReactTooltip effect="float" type="info" place="top" />
                        <i className="fas fa-heart fa-fw text-danger"></i></button >)
                    :
                    (<button onClick={PostFavoriteButton} className="btn p-0 border-0" data-tip="いいねボタン">
                        <ReactTooltip effect="float" type="info" place="top" />
                        <i className="far fa-heart fa-fw text-primary"></i></button>)
            }
            <p className="mb-0 text-secondary">{props.timeline.favorites.length}</p>
        </>
    )
}

export default FavoriteButton
