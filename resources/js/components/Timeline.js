import React from 'react'
import { Link } from 'react-router-dom'


const Timeline = (props) => {
    return props.timelines.map(timeline => {
        return (
            <div className="card shadow-sm mb-3">
                <div className="card-header p-3 w-100 d-flex">
                    <div className="ml-2 d-flex flex-column">
                        <Link to={`/users/${timeline.user.id}`}>
                            <p>{timeline.user.name}</p>
                            <span>{timeline.user.screen_name}</span>
                        </Link>
                    </div>
                    <div className="d-flex justify-content-end flex-grow-1">
                        <p></p>
                    </div>
                </div>
                <div className="card-body border-top border-bottom">
                    <div className="d-flex p-2">
                        <div className="d-flex flex-column mb-3 p-2">
                            <img src={timeline.image_url}></img>
                        </div>
                    </div>
                </div>
            </div>
        )
    })

    //コンポーネントがマウントされた時点で初期描画用のtodosをAPIから取得



}

export default Timeline
