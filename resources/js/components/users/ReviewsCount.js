import React from 'react'

const ReviewsCount = (props) => {

    const reviewsCount = props.user.reviews_count

    return (
        <>
            <span>投稿数</span><span className="badge-purple badge-pill text-white ml-1 user-select-none">{reviewsCount}</span>
        </>
    )
}
export default ReviewsCount

