import React, { useState, useEffect } from 'react'
import Ratings from './Ratings'

const RatingsWrapper = () => {

    const [ratings, setRatings] = useState()
    const currentUrl = window.location.pathname

    useEffect(async () => {
        const loadRatings = async () => {
            await axios
                .get(`/api${currentUrl}`)
                .then(res => {
                    setRatings(res.data.ratings)
                })
                .catch(err => {
                    console.log(err)
                })
        }
        loadRatings()
    }, [])

    return (
        <>
            <Ratings ratings={ratings} />
        </>
    )
}

export default RatingsWrapper


