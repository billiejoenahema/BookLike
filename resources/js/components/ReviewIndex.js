import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import Timeline from './Timeline'

const ReviewIndex = () => {

    const [loginUser, setLoginUser] = useState()
    const [timelines, setTimelines] = useState([])
    const [selectedFavo, setSelectedFavo] = useState(false)
    const [page, setPage] = useState(1)
    const [hasMore, setHasMore] = useState(false)
    const [loading, setLoading] = useState(false)
    const [searchWord, setSearchWord] = useState('')


    useEffect(() => {
        const loadTimeline = async () => {
            setLoading(true)
            const newTimelines = await axios
                .get(`/api/reviews?page=${page}`)
                .then(res => {
                    console.log(res)
                    setLoginUser(res.data.loginUser)
                    if (page < res.data.timelines.last_page) {
                        setHasMore(true)
                    }
                    if (selectedFavo) {
                        return res.data.favoritest.data
                    }
                    return res.data.timelines.data
                })
                .catch(err => {
                    console.log(err)
                })
            setTimelines(prev => [...prev, ...newTimelines])
            setLoading(false)
        }
        loadTimeline()
    }, [page, selectedFavo])

    const reviewList = timelines.filter((item) => {
        return item.title.indexOf(searchWord) > -1
    })

    const handleSearch = (e) => {
        setSearchWord(e.target.value)
    }

    const handleChange = (e) => {
        if (e.target.value === 'favorite') {
            setSelectedFavo(true)
            setTimelines([])
            setPage(1)
            setHasMore(false)
        } else {
            setSelectedFavo(false)
        }
    }

    const body = document.getElementById('body')
    body.onscroll = () => {
        const scrollTop = window.scrollY
        const clientHeight = document.getElementById('timelinesComponent').clientHeight
        if (hasMore && clientHeight - scrollTop < 800) {
            setPage(prev => prev + 1)
            setHasMore(false)
        }
        return
    }

    return (
        <>
            <input
                className="form-control col-4 search-form rounded-pill pr-0"
                onChange={handleSearch}
                type="search"
                value={searchWord}
                placeholder="タイトル検索..."
                aria-label="タイトル検索"
                required autoComplete="on"
            />
            <div className="form-group d-flex justify-content-end">
                <div className="d-flex flex-row col-8">
                    <label htmlFor="selectSort" className="w-100 text-right py-1 mr-1">並び替え</label>
                    <select onChange={handleChange} className="form-control-sm" id="selectSort">
                        <option value="default">新着順</option>
                        <option value="favorite">いいね数</option>
                    </select>
                </div>
            </div>
            <div id="timelinesComponent">
                <Timeline timelines={reviewList} loginUser={loginUser} />
            </div>
            <div className="text-center">
                {loading && '読み込み中...'}
            </div>
        </>
    )

}

export default ReviewIndex

if (document.getElementById('reviewIndex')) {
    ReactDOM.render(<ReviewIndex />, document.getElementById('reviewIndex'))
}
