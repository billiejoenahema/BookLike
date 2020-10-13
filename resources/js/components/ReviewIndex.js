import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import Timeline from './Timeline'

const ReviewIndex = () => {

    const [loginUser, setLoginUser] = useState()
    const [timelines, setTimelines] = useState([])
    const [selectedCategory, setSelectedCategory] = useState('')
    const [selectedValue, setSelectedValue] = useState('title')
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

    const categoryChange = (e) => {
        const selected = e.target.value
        console.log(selected)
        if (selected === 'default') {
            setTimelines([])
            setPage(1)
            setHasMore(false)
        }
        setSelectedCategory(selected)
        setTimelines([])
        setPage(1)
        setHasMore(false)
    }

    const sortChange = (e) => {
        selectedFavo ? setSelectedFavo(false) : setSelectedFavo(true)
        // if (selectedFavo) {
        //     setSelectedFavo(false)
        // } else {
        //     setSelectedFavo(true)
        // }
        setTimelines([])
        setPage(1)
        setHasMore(false)
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

    const itemChange = (e) => {
        setSearchWord('')
        const selectedIndex = e.target.selectedIndex
        const item = e.target.options[selectedIndex].label
        document.getElementById('searchBooks').placeholder = `${item}で検索...`
        setSelectedValue(e.target.options[selectedIndex].value)
    }

    const handleSearch = (e) => {
        setSearchWord(e.target.value)
        setPage(1)

    }

    const reviewList = (selectedValue) => {
        return timelines.filter((item) => {
            if (item[selectedValue]) {
                return item[selectedValue].indexOf(searchWord) > -1
            }
            if (selectedCategory) {
                return item.category.indexOf(selectedCategory) > -1
            }
            return
        })
    }

    return (
        <>
            <div className="search-form d-inline-flex">
                <select onChange={itemChange} id="bookSearch" className="text-right bg-transparent border-0 mr-1">
                    <option value="title">タイトル</option>
                    <option value="author">著者</option>
                    <option value="manufacturer">出版社</option>
                </select>
                <input
                    className="form-control rounded-pill pr-0"
                    id="searchBooks"
                    onChange={handleSearch}
                    type="search"
                    value={searchWord}
                    placeholder="タイトルで検索..."
                    aria-label="書籍検索"
                    required autoComplete="on"
                />
            </div>
            <div className="form-group d-flex justify-content-between mt-2">
                <select onChange={categoryChange} className="form-control-sm" placeholder="カテゴリーで絞り込み">
                    <option value="default">カテゴリーで絞り込み</option>
                    <option value="文学">文学</option>
                    <option value="エンターテインメント">エンターテインメント</option>
                    <option value="ミステリー">ミステリー</option>
                    <option value="SF">SF</option>
                    <option value="ホラー">ホラー</option>
                    <option value="ファンタジー">ファンタジー</option>
                    <option value="青春・恋愛">青春・恋愛</option>
                    <option value="歴史・時代">歴史・時代</option>
                    <option value="ノンフィクション">ノンフィクション</option>
                    <option value="ビジネス・経済">ビジネス・経済</option>
                    <option value="コンピュータ・IT">コンピュータ・IT</option>
                    <option value="コミック">コミック</option>
                    <option value="ライトノベル">ライトノベル</option>
                    <option value="その他">その他</option>
                </select>
                <div className="d-flex flex-row p-0">
                    <label htmlFor="selectSort" className="w-100 text-right py-1 mr-1">並び替え</label>
                    <select onChange={sortChange} className="form-control-sm" id="selectSort">
                        <option value="default">新着順</option>
                        <option value="favorite">いいね数</option>
                    </select>
                </div>
            </div>
            <div id="timelinesComponent">
                <Timeline timelines={reviewList(selectedValue)} loginUser={loginUser} />
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
