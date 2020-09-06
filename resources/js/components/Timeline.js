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

    deleteReview((id) => {
        axios.delete(`reviews/${id}`)
            .then(response => {
                console.log(response);
                console.log(response.data);
            })
    })

    return (
        <Fragment>
            {timelines.map((timeline) =>
                <div className="card shadow-sm mb-3" key="{timeline.id}" >
                    <div className="card-haeder p-3 w-100 d-flex">
                        <img src={`/storage/profile_image/${timeline.user.profile_image}`} className="rounded-circle shadow-sm" width="50" height="50" />
                        <div className="ml-2 d-flex flex-column">
                            <p className="mb-0">{timeline.user.name}</p>
                            <span className="text-secondary">{timeline.user.screen_name}</span>
                        </div>
                        <div className="d-flex justify-content-end flex-grow-1">
                            <p className="mb-0 text-secondary">{timeline.created_at}</p>
                        </div>
                    </div>
                    <div className="card-body border-top border-bottom">
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
                        <p className="d-block text-reset">{timeline.text}</p>
                    </div>
                    <div className="card-footer py-1 d-flex justify-content-end bg-white">
                        {/* 投稿の編集削除アイコン */}
                        {(() => {
                            if (timeline.user.id === loginUser.id) {
                                return (
                                    <div className="dropdown mr-3 d-flex align-items-center">
                                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i className="fas fa-ellipsis-v fa-fw"></i>
                                        </a>
                                        <div className="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <form method="POST" action="" className="mb-0">
                                                <a href={`reviews/${timeline.id}/edit`}
                                                    className="dropdown-item">編集</a>
                                                <button type="submit" onClick={() => this.deleteReview(timeline.id)} className="dropdown-item del-btn">削除</button>
                                            </form>
                                        </div>
                                    </div>
                                )
                            }
                        })()}
                    </div>
                </div>
            )
            }
        </Fragment >
    )
}

export default Timeline
