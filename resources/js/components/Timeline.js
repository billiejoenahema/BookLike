import React, { Fragment } from 'react'
import ReactTooltip from 'react-tooltip'
import FavoriteButton from './FavoriteButton'

function Timeline(props) {

    return (
        <Fragment>
            {props.timelines.map((timeline) =>
                <div className="card shadow-sm mb-3" key={timeline.id} >
                    <div className="card-haeder p-3 w-100 d-flex">
                        <img src={`/storage/profile_image/${timeline.user.profile_image}`} className="rounded-circle shadow-sm" width="48" height="48" />
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
                                if (timeline.user.id === props.loginUser.id) {
                                    return (
                                        <a href={`reviews/${timeline.id}/edit`}
                                            data-tip="投稿を編集"><i className="fas fa-edit"></i>
                                            <ReactTooltip effect="float" type="info" place="top" /></a>
                                    )
                                }
                            })()}
                        </div>
                        {/* コメントボタン */}
                        <div className="mr-3 d-flex align-items-center">
                            <a href={`reviews/${timeline.id}`} data-tip="コメントを投稿"><i className="far fa-comment fa-fw"></i>
                                <ReactTooltip effect="float" type="info" place="top" /></a>
                            <p className="mb-0 text-secondary">{timeline.comments.length}</p>
                        </div>
                        {/* いいねボタン */}
                        <div className="mr-3 d-flex align-items-center">
                            <FavoriteButton
                                timeline={timeline}
                                loginUser={props.loginUser} />
                        </div>
                    </div>
                </div>
            )
            }
        </Fragment >
    )
}

export default Timeline
