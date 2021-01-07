import React, { useState, useEffect } from 'react'
import ReactDOM from 'react-dom'
import FavoriteButton from './FavoriteButton'

const FavoriteButtonWrapper = () => {

    const [review, setReview] = useState()
    const [loginUser, setLoginUser] = useState()
    const currentUrl = window.location.pathname

    useEffect(() => {
        const loadIsFavorited = async () => {
            await axios
                .get(`/api${currentUrl}`)
                .then(res => {
                    setReview(res.data.review)
                    setLoginUser(res.data.loginUser)
                })
                .catch(err => {
                    console.log(err)
                })
        }
        loadIsFavorited()
    }, [])

    return (
        <>
            {review && loginUser && <FavoriteButton timeline={review} loginUser={loginUser} />}
        </>
    )
}

export default FavoriteButtonWrapper
if (document.getElementById('favoriteButtonWrapper')) {
    ReactDOM.render(<FavoriteButtonWrapper />, document.getElementById('favoriteButtonWrapper'))
}
