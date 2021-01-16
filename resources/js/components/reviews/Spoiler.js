import React from 'react'

const Spoiler = (props) => {
    const isSpoiler = (props.spoiler === 1) ? true : false
    return (
        <>
            {
                isSpoiler ?
                    <span className="badge badge-danger">ネタバレあり</span>
                    : <span className="badge badge-info">ネタバレなし</span>
            }
        </>
    )
}

export default Spoiler
