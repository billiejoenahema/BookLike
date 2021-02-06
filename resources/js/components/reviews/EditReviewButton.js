import React from 'react'

const EditReviewButton = (props) => {

    const reviewId = props.review.id

    return (
        <>
            <a href={`/reviews/${reviewId}/edit`} className="edit text-secondary pr-2">
                <span className="edit-text"><i className="fas fa-fw fa-edit"></i>編集</span>
            </a>
        </>
    )
}

export default EditReviewButton
