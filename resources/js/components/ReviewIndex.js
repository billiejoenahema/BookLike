import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import Timeline from './Timeline'

const ReviewIndex = () => {

    const [loginUser, setLoginUser] = useState()
    const [timelines, setTimelines] = useState([])
    const [timelinesLength, setTimelinesLength] = useState(0)
    const [selectedCategory, setSelectedCategory] = useState('')
    const [selectedValue, setSelectedValue] = useState('title')
    const [selectedFavo, setSelectedFavo] = useState(false)
    const [page, setPage] = useState(1)
    const [hasMore, setHasMore] = useState(false)
    const [loading, setLoading] = useState(false)
    const [searchWord, setSearchWord] = useState('')
    const searchBooks = document.getElementById('searchBooks')
    const modalSearchBooks = document.getElementById('modalSearchBooks')

    useEffect(() => {
        const loadTimeline = async () => {
            setLoading(true)
            const newTimelines = await axios
                .get(`/api/reviews?page=${page}`)
                .then(res => {
                    console.log(res)
                    setLoginUser(res.data.loginUser)
                    page < res.data.timelines.last_page && setHasMore(true)
                    if (selectedFavo) {
                        return res.data.favoritest.data
                    }
                    return res.data.timelines.data
                })
                .catch(err => {
                    console.log(err)
                })
            const addTimelines = newTimelines.filter((item) => {
                return item[selectedValue].indexOf(searchWord) > -1
            })
            setTimelinesLength(addTimelines.length)
            setTimelines(prev => [...prev, ...addTimelines])
            setLoading(false)
        }
        loadTimeline()
    }, [page, selectedFavo, selectedCategory, searchWord])

    const selectItem = (e) => {
        const selectedIndex = e.target.selectedIndex
        const item = e.target.options[selectedIndex].label
        searchBooks.placeholder = `${item}で検索...`
        setSelectedValue(e.target.options[selectedIndex].value)
        setHasMore(false)
    }

    const searchClick = (e) => {
        e.preventDefault()
        console.log('search button clicked!')
        console.log(`search word: ${searchBooks.value}`)
        setTimelines([])
        setPage(1)
        setSearchWord(searchBooks.value)
        setHasMore(false)
    }

    const modalSearchClick = (e) => {
        console.log('search button clicked!')
        console.log(`search word: ${modalSearchBooks.value}`)
        setTimelines([])
        setPage(1)
        setSearchWord(modalSearchBooks.value)
        setHasMore(false)
    }

    const categoryChange = (e) => {
        const selected = e.target.value
        console.log(`selected: ${selected}`)
        if (selected === 'default') {
            setSelectedCategory('')
            setSearchWord('')
            return
        }
        setSelectedCategory(selected)
        setSearchWord('')
    }

    const sortChange = (e) => {
        console.log('sort changed!')
        selectedFavo ? setSelectedFavo(false) : setSelectedFavo(true)
        setTimelines([])
        setPage(1)
        setHasMore(false)
        setSearchWord('')
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

    useEffect(() => {
        if (timelinesLength < 10 && hasMore) {
            setPage(prev => prev + 1)
            setHasMore(false)
        }
        return
    }, [timelines])

    return (
        <>
            <div className="search-form">
                <div className="d-flex flex-row">
                    <select onChange={selectItem} className="text-right bg-transparent border-0 mr-1">
                        <option value="title">タイトル</option>
                        <option value="author">著者</option>
                        <option value="manufacturer">出版社</option>
                    </select>
                    <input
                        className="form-control rounded-pill pr-0"
                        id="searchBooks"
                        type="search"
                        name="search"
                        placeholder="タイトルで検索..."
                        aria-label="書籍検索"
                        required autoComplete="on"
                    />
                    <button onClick={searchClick} className="btn search-button">
                        <i className="fas fa-search text-teal lead"></i>
                    </button>
                </div>
            </div>
            {/* Button trigger modal */}
            <button type="button" className="btn search-modal-button search-modal" data-toggle="modal" data-target="#searchModal">
                <i className="fas fa-search text-teal lead"></i>
            </button>
            {/* Search Modal */}
            <div className="modal fade search-modal" id="searchModal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div className="modal-dialog" role="document">
                    <div className="modal-content">
                        <div className="modal-body">
                            <div className="d-flex flex-row">
                                <select onChange={selectItem} className="text-right bg-transparent border-0 mr-1">
                                    <option value="title">タイトル</option>
                                    <option value="author">著者</option>
                                    <option value="manufacturer">出版社</option>
                                </select>
                                <input
                                    className="form-control rounded-pill pr-0"
                                    id="modalSearchBooks"
                                    type="search"
                                    name="search"
                                    placeholder="タイトルで検索..."
                                    aria-label="書籍検索"
                                    required autoComplete="on"
                                />
                                <button onClick={modalSearchClick} className="btn search-button" data-dismiss="modal">
                                    <i className="fas fa-search text-teal lead"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {/* カテゴリー選択 */}
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
                <Timeline timelines={timelines} loginUser={loginUser} />
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


