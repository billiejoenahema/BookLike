import React from 'react'
import ReactTooltip from 'react-tooltip'
import FavoriteButton from './FavoriteButton'
import EditReviewButton from './EditReviewButton'
import omittedText from '../functions/omittedText'
import { STORAGE } from '../constants'

function Timeline(props) {

    const { timelines, loginUser } = props

    return (
        <>
            {timelines.map((timeline) => (
                <div className="card shadow-sm mb-3" key={timeline.id}>
                    <div className="card-haeder p-3 d-flex">
                        <a href={`/users/${timeline.user.id}`} className="text-reset" data-tip="プロフィールページへ">
                            <img src={`${STORAGE}/${timeline.user.profile_image}`}
                                className="rounded-circle shadow-sm"
                                width="48" height="48" />
                            <ReactTooltip effect="float" type="info" place="top" />
                        </a>
                        <div className="ml-2 d-flex flex-column">
                            <p className="mb-0">{timeline.user.name || timeline.user.screen_name}</p>
                            <span className="text-secondary">{timeline.user.screen_name}</span>
                        </div>
                        <div className="d-flex justify-content-end flex-grow-1">
                            <p className="mb-0 text-secondary">{formatDate(timeline.created_at, 'yyyy-MM-dd')}</p>
                        </div>
                    </div>
                    <div className="card-body py-0 px-3">
                        <div className="d-flex flex-row py-3 border-top border-bottom">
                            <a href={`/reviews/${timeline.id}`} className="d-block text-reset text-decoration-none" data-tip="投稿の詳細ページへ">
                                <div>
                                    <img src={timeline.image_url} width="100" className="shadow-sm" />
                                </div>
                                <ReactTooltip effect="float" type="info" place="top" />
                            </a>
                            <div className="col-md-8 d-flex flex-column text-left pl-3 px-0">
                                <h5 className="mb-3">{timeline.title}</h5>
                                <ul className="list-unstyled">
                                    <li><span>著者：</span>{timeline.author}</li>
                                    <li><span>出版社：</span>{timeline.manufacturer}</li>
                                    <li><span>カテゴリー：</span><span className="btn p-0 text-blue anchor" onClick={props.changeCategory} data-category={timeline.category}>{timeline.category}</span></li>
                                    <li>
                                        <object><a href={timeline.page_url} target="_blank" rel="noopener" data-tip="Amazonサイトへ移動">
                                            <i className="fab fa-amazon"></i> Amazon
                                                <ReactTooltip effect="float" type="info" place="top" />
                                        </a></object>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div className="card-body p-0">
                        <a href={`/reviews/${timeline.id}`} className="d-block p-3 text-reset text-decoration-none" data-tip="投稿の詳細ページへ">
                            {omittedText(timeline.text, 80)}
                            <ReactTooltip effect="float" type="info" place="top" />
                        </a>
                    </div>
                    <div className="card-footer pb-3 px-3 d-flex justify-content-end bg-white border-top-0">

                        {/* 投稿を編集 */}
                        {loginUser.id === timeline.user.id && <EditReviewButton timeline={timeline} />}

                        {/* コメントボタン */}
                        <div className="d-flex align-items-center">
                            <a href={`/reviews/${timeline.id}`}><i className="far fa-comment fa-fw text-blog"></i></a>
                            <p className="mb-0 text-secondary">{timeline.comments.length}</p>
                        </div>
                        {/* いいねボタン */}
                        <div className="ml-4 mr-3 d-flex align-items-center">
                            <FavoriteButton timeline={timeline} loginUser={loginUser} />
                        </div>
                    </div>
                </div>
            ))}
        </>
    )
}

export default Timeline
