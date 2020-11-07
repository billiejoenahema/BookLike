import React from 'react'
import ReactTooltip from 'react-tooltip'
import FavoriteButton from './FavoriteButton'
import omittedText from '../functions/omittedText'

function Timeline(props) {

    const url = 'http://booklikeapp.com'

    return (
        <>
            {props.timelines.map((timeline) => (
                <div className="card shadow-sm mb-3" key={timeline.id}>
                    <div className="card-haeder p-3 d-flex">
                        <a href={`${url}/users/${timeline.user.id}`} className="text-reset">
                            <img src={`/storage/profile_image/${timeline.user.profile_image}`}
                                className="rounded-circle shadow-sm"
                                width="48" height="48" />
                        </a>
                        <div className="ml-2 d-flex flex-column">
                            <p className="mb-0">{timeline.user.name}</p>
                            <span className="text-secondary">{timeline.user.screen_name}</span>
                        </div>
                        <div className="d-flex justify-content-end flex-grow-1">
                            <p className="mb-0 text-secondary">{timeline.created_at.slice(0, -8)}</p>
                        </div>
                    </div>
                    <div className="card-body border-top border-bottom py-0">
                        <a href={`${url}/reviews/${timeline.id}`} className="d-block text-reset text-decoration-none">
                            <div className="d-flex flex-row py-2">
                                <div className="py-2 pr-4">
                                    <img src={timeline.image_url} width="100" className="shadow-sm" />
                                </div>
                                <div className="col-md-8 d-flex flex-column text-left py-2 px-0">
                                    <h5 className="mb-3">{timeline.title}</h5>
                                    <ul className="list-unstyled">
                                        <li><span>著者：</span>{timeline.author}</li>
                                        <li><span>出版社：</span>{timeline.manufacturer}</li>
                                        <li><span>カテゴリー：</span>{timeline.category}</li>
                                        <li><object><a href={timeline.page_url} target="_blank" rel="noopener" data-tip="Amazonサイトへ移動"><i className="fab fa-amazon"></i> Amazon<ReactTooltip effect="float" type="info" place="top" /></a></object></li>
                                    </ul>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div className="card-body">
                        <a href={`${url}/reviews/${timeline.id}`} className="d-block text-reset text-decoration-none">
                            {omittedText(timeline.text, 100)}
                        </a>
                    </div>
                    <div className="card-footer py-1 d-flex justify-content-end bg-white">
                        {/* 投稿編集ボタン */}
                        <div className="mr-3 d-flex align-items-center">
                            {(() => {
                                if (timeline.user.id === props.loginUser.id) {
                                    return (
                                        <a href={`${url}/reviews/${timeline.id}/edit`}
                                            data-tip="投稿を編集"><i className="fas fa-pen text-blog"></i>
                                            <ReactTooltip effect="float" type="info" place="top" /></a>
                                    )
                                }
                            })()}
                        </div>
                        {/* コメントボタン */}
                        <div className="mr-3 d-flex align-items-center">
                            <a href={`${url}/reviews/${timeline.id}`} data-tip="コメントを投稿"><i className="far fa-comment fa-fw text-blog"></i>
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
            ))}
        </>
    )
}

export default Timeline
