import React from 'react'
import ReactTooltip from 'react-tooltip'

const EditReviewButton = (props) => {

    const timelineId = props.timeline.id

    return (
        <div className="flex-grow-1">
            <a href={`/reviews/${timelineId}/edit`} role="button" className="text-reset" data-tip="投稿を編集">
                <i className="fas fa-fw fa-ellipsis-v"></i><ReactTooltip effect="float" type="info" place="top" />
            </a>
        </div>
    )
}

export default EditReviewButton
