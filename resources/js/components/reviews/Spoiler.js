import React from 'react'

const Spoiler = (props) => {
    const isSpoiler = (props.spoiler === 1) ? true : false
    return (
        <>
            {
                isSpoiler ?
                    <span className="badge badge-pill badge-danger pt-1">ネタバレあり</span>
                    : <span className="badge badge-pill badge-info pt-1">ネタバレなし</span>
            }
        </>
    )
}

export default Spoiler
