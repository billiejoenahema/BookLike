import React from 'react'
import ReactTooltip from 'react-tooltip'

const EditReviewButton = (props) => {

    const reviewId = props.review.id

    return (
        <>
            <a href={`/reviews/${reviewId}/edit`} role="button" className="text-secondary py-0 pl-0 pr-2">
                <span className="edit"><i className="fas fa-fw fa-edit"></i> 編集</span>
            </a>
        </>
    )
}

export default EditReviewButton
