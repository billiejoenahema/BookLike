import React, { useState, useEffect, useCallback } from "react"
import ReactTooltip from 'react-tooltip'

const FavoriteButton = (props) => {

    // function isFavorite(timeline, loginUser) {
    //     const favoritesArray = Array.from(timeline.favorites)
    //     const userIds = favoritesArray.map(v => v.user_id)
    //     console.log(loginUser.id)
    //     return userIds.includes(loginUser.id)
    // }
    const timeline = props.timeline
    const loginUser = props.loginUser

    const favorited = ((timeline, loginUser) => {
        const favoritesArray = Array.from(timeline.favorites)
        const userIds = favoritesArray.map(v => v.user_id)
        return userIds.includes(loginUser.id)
    })

    // const [favorited, setFavorite] = useState(InitialState)
    // const ToggleFavorite = useCallback(() => setFavorite((prev) => !prev), [setFavorite])

    const PostFavoriteButton = (e) => {
        e.preventDefault()
        const review_id = props.timeline.id
        return axios.post('api/favorites', { review_id: review_id })
            .then(res => {
            })
            .catch(err => {
                console.log('失敗！')
            })
    }

    const DeleteFavoriteButton = (e) => {
        e.preventDefault()
        ToggleFavorite
        const favoritesArray = Array.from(props.timeline.favorites)
        const favoritesIds = favoritesArray.map(v => v.id)
        const id = favoritesIds[0]
        return axios.delete(`api/favorites/${id}`)
            .then(res => {
            })
            .catch(err => {
                console.log('失敗！')
            })
    }

    return (
        <>
            {
                favorited(timeline, loginUser) ?
                    (<button onClick={DeleteFavoriteButton} className="btn p-0 border-0" data-tip="いいねボタン" >
                        <ReactTooltip effect="float" type="info" place="top" />
                        <i className="fas fa-heart fa-fw text-danger"></i></button >)
                    :
                    (<button onClick={PostFavoriteButton} className="btn p-0 border-0" data-tip="いいねボタン">
                        <ReactTooltip effect="float" type="info" place="top" />
                        <i className="far fa-heart fa-fw text-primary"></i></button>)
            }
        </>
    )
}

export default FavoriteButton
