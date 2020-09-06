import React, { useEffect, useState, Fragment } from 'react'
import { Link } from 'react-router-dom'
import axios from 'axios'

function Timeline() {

    // 投稿を取得
    const [timelines, setTimelines] = useState([])

    useEffect(() => {
        getTimelines()
    }, [])

    const getTimelines = async () => {
        const response = await axios.get('/api/reviews')
        setTimelines(response.data.timelines)
    }

    const [loginUser, setLoginUser] = useState([])

    useEffect(() => {
        getLoginUser()
    }, [])

    const getLoginUser = async () => {
        const response = await axios.get('/api/reviews')
        setLoginUser(response.data.loginUser)
    }

    return (
        <Fragment>
            {timelines.map((timeline) =>
                <div className="card shadow-sm mb-3" key={timeline.id} >
                    <div className="card-haeder p-3 w-100 d-flex">
                        <img src={`/storage/profile_image/${timeline.user.profile_image}`} className="rounded-circle shadow-sm" width="50" height="50" />
                        <div className="ml-2 d-flex flex-column">
                            <a href={`users/${timeline.user.id}`} className="text-reset">
                                <p className="mb-0">{timeline.user.name}</p>
                                <span className="text-secondary">{timeline.user.screen_name}</span>
                            </a>
                        </div>
                        <div className="d-flex justify-content-end flex-grow-1">
                            <p className="mb-0 text-secondary">{timeline.created_at.slice(0, -8)}</p>
                        </div>
                    </div>
                    <div className="card-body border-top border-bottom py-0">
                        <div className="d-flex p-2">
                            <div className="d-flex flex-column mb-3 p-2">
                                <img src={timeline.image_url} width="80" className="shadow-sm" />
                            </div>
                            <div className="d-flex flex-column text-left p-2" >
                                {timeline.title}
                            </div>
                        </div>
                    </div>
                    <div className="card-body">
                        <a href={`reviews/${timeline.id}`} className="d-block text-reset">{timeline.text}</a>
                    </div>
                    <div className="card-footer py-1 d-flex justify-content-end bg-white">
                        {/* 投稿編集ボタン */}
                        <div className="mr-3 d-flex align-items-center">
                            {(() => {
                                if (timeline.user.id === loginUser.id) {
                                    return (
                                        <a href={`reviews/${timeline.id}/edit`} ><i className="fas fa-edit"></i></a>
                                    )
                                }
                            })()}
                        </div>
                        {/* コメントボタン */}
                        <div className="mr-3 d-flex align-items-center">
                            <a href={`reviews/${timeline.id}`}><i className="far fa-comment fa-fw"></i></a>
                            <p className="mb-0 text-secondary">{timeline.comments.length}</p>
                        </div>
                        {/* いいねボタン */}
                        <div className="mr-3 d-flex align-items-center">
                            <p className="mb-0 text-secondary">{timeline.favorites.length}</p>
                        </div>
                    </div>
                </div>
            )
            }
        </Fragment >
    )
}

export default Timeline
