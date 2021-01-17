import React from 'react'
import ReactTooltip from 'react-tooltip'

const EditReviewButton = (props) => {

    const reviewId = props.review.id

    return (
        <>
            <a href={`/reviews/${reviewId}/edit`} role="button" className="btn py-0 pl-0" data-tip="投稿を編集">
                <i className="fas fa-fw fa-edit text-secondary anchor"></i><ReactTooltip effect="float" type="info" place="top" />
            </a>
        </>
    )
}

export default EditReviewButton
