import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import Timeline from './Timeline'
import Loading from './Loading'

const ReviewIndex = () => {

    // 投稿詳細ページのリンクをクリックしたときのためにparamsから初期値を取得
    const params = (new URL(document.location)).searchParams
    const initialSearchWord = params.get('search') || ''
    const initialCriteria = params.get('value') || 'title'
    const initialCategory = params.get('category') || 'default'

    const [loginUser, setLoginUser] = useState()
    const [timelines, setTimelines] = useState([])
    const [category, setCategory] = useState(initialCategory)
    const [criteria, setCriteria] = useState(initialCriteria)
    const [sort, setSort] = useState('default')
    const [page, setPage] = useState(1)
    const [hasMore, setHasMore] = useState(false)
    const [loading, setLoading] = useState(false)
    const [searchWord, setSearchWord] = useState(initialSearchWord)

    useEffect(() => {
        const loadTimeline = async () => {
            setLoading(true)
            const newTimelines = await axios
                .get(`/api/reviews?criteria=${criteria}&search=${searchWord}&category=${category}&sort=${sort}&page=${page}`)
                .then(res => {
                    setLoginUser(res.data.loginUser)
                    page < res.data.timelines.last_page && setHasMore(true)
                    return res.data.timelines.data
                })
                .catch(err => {
                    console.log(err)
                })
            // const addTimelines = newTimelines.filter(item => {
            //     return item[criteria].indexOf(searchWord) > -1
            // })
            setTimelines(prev => [...prev, ...newTimelines])
            setLoading(false)
        }
        loadTimeline()
    }, [page, category, searchWord, sort])

    // カテゴリー選択時にセレクトボックスを操作する
    const changeSelectBox = (selectedCategory) => {
        console.log('Change select box!')
        const selectedOption = document.getElementById('categorySelector').options
        for (const option of selectedOption) {
            option.selected = false
            if (option.value === selectedCategory) {
                option.selected = true
            }
        }
    }

    // 検索条件を選択
    const selectCriteria = (e) => {
        const searchBooks = document.getElementById('searchBooks') || document.getElementById('modalSearchBooks')
        const selectedIndex = e.target.selectedIndex
        const selectedCriteria = e.target.options[selectedIndex].label
        searchBooks.value = ''
        searchBooks.placeholder = `${selectedCriteria}で検索...`
        modalSearchBooks.placeholder = `${selectedCriteria}で検索...`
        setHasMore(false)
        setCriteria(e.target.options[selectedIndex].value)
    }

    // 検索ワード入力時の処理
    const searchSubmit = (e) => {
        e.preventDefault()
        const searchBooks = document.getElementById('searchBooks')

        // フォーカスを外す
        searchBooks.blur()

        // 検索ワードに変化がなければ何もしない
        if (searchBooks.value === searchWord) return

        setSearchWord('')
        setTimelines([])
        setPage(1)
        setHasMore(false)
        setSearchWord(searchBooks.value)
    }

    // 検索ワード入力時の処理（スマホ用）
    const modalSearchSubmit = (e) => {
        e.preventDefault()
        const modalSearchBooks = document.getElementById('modalSearchBooks')
        const modalMapDrop = document.getElementsByClassName('modal-backdrop')[0]
        const searchModal = document.getElementById('searchModal')
        const modalSearchButton = document.getElementById('modalSearchButton')

        // フォーカスを外す
        modalSearchButton.blur()

        // 検索ワードに変化がなければ何もしない
        if (modalSearchBooks.value === searchWord) return

        // モーダルを閉じる
        searchModal.classList.remove('show')
        modalMapDrop.classList.remove('show')
        setTimelines([])
        setPage(1)
        setHasMore(false)
        setSearchWord(modalSearchBooks.value)
    }

    // セレクトボックスを操作またはアンカーテキストをクリックしたときの処理
    const changeCategory = (e) => {
        console.log('Category changed!')
        const selectedValue = document.getElementById('categorySelector').value
        const clickedCategory = e.target.dataset.category
        const selectedCategory = clickedCategory || selectedValue

        if (clickedCategory === selectedValue) return

        changeSelectBox(selectedCategory)
        setTimelines([])
        setCategory(selectedCategory)
        setPage(1)
        setHasMore(false)
    }

    // 一覧の並び替え
    const sortChange = () => {
        console.log('sort changed!')
        const selectedSort = document.getElementById('selectSort').value
        setSort(selectedSort)
        setTimelines([])
        setPage(1)
        setHasMore(false)
    }

    // 一定量スクロールしたら投稿をさらに読み込み
    const body = document.getElementById('body')
    body.onscroll = () => {
        const scrollAmount = window.scrollY
        const clientHeight = document.getElementById('timelinesComponent').clientHeight

        if (hasMore && clientHeight - scrollAmount < 1200) {
            setPage(prev => prev + 1)
            setHasMore(false)
        }
        return
    }

    return (
        <>
            {/* 投稿検索フォーム */}
            <div className="search-form">
                <div className="d-flex flex-row">
                    <select onChange={selectCriteria} className="text-right text-graphite bg-transparent border-0 mr-1">
                        <option value="title">タイトル</option>
                        <option value="author">著者</option>
                        <option value="manufacturer">出版社</option>
                    </select>
                    <form onSubmit={searchSubmit}>
                        <input
                            className="form-control rounded-pill pr-0"
                            id="searchBooks"
                            type="search"
                            name="search"
                            placeholder="タイトルで検索..."
                            aria-label="書籍検索"
                            autoComplete="on"
                        />
                    </form>
                </div>
            </div>

            {/* スマホ用検索ボタン */}
            <button type="button" id="modalSearchButton" className="btn search-modal-button search-modal" data-toggle="modal" data-target="#searchModal">
                <i className="fas fa-search text-teal"></i>
            </button>
            {/* スマホ用検索モーダル */}
            <div className="modal fade search-modal" id="searchModal" tabIndex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
                <div className="modal-dialog" role="document">
                    <div className="modal-content">
                        <div className="modal-body">
                            <div className="d-flex flex-row">
                                <select onChange={selectCriteria} className="text-right bg-transparent border-0 mr-1">
                                    <option value="title">タイトル</option>
                                    <option value="author">著者</option>
                                    <option value="manufacturer">出版社</option>
                                </select>
                                <form onSubmit={modalSearchSubmit}>
                                    <input
                                        className="form-control rounded-pill pr-0"
                                        id="modalSearchBooks"
                                        type="search"
                                        name="search"
                                        placeholder="タイトルで検索..."
                                        aria-label="書籍検索"
                                        autoComplete="on"
                                    />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="search-word-display">
                {searchWord && `検索ワード: \"${searchWord}\"`}
            </div>

            <div className="form-group d-flex justify-content-between mt-2 flex-wrap mb-2">
                {/* カテゴリー選択 */}
                <select onChange={changeCategory} id="categorySelector" className="form-control-sm mt-1 mt-sm-0" placeholder="カテゴリーで絞り込み">
                    <option value="default">すべてのカテゴリー</option>
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
                {/* 並び替え */}
                <div className="d-flex flex-row p-0 mt-1 mt-sm-0">
                    <label htmlFor="selectSort" className="text-right py-1 mr-1">並び替え</label>
                    <select onChange={sortChange} className="form-control-sm" id="selectSort">
                        <option value="default">新着順</option>
                        <option value="favorite">いいね数</option>
                    </select>
                </div>
            </div>

            {/* 投稿一覧 */}
            <div id="timelinesComponent">
                <Timeline timelines={timelines} loginUser={loginUser} changeCategory={changeCategory} />
            </div>

            {/* Loading Spinner */}
            <div className="text-center">
                {loading && < Loading />}
                {!loading && (timelines.length === 0) && '該当する投稿は見つかりませんでした'}
            </div>
        </>
    )
}

export default ReviewIndex

if (document.getElementById('reviewIndex')) {
    ReactDOM.render(<ReviewIndex />, document.getElementById('reviewIndex'))
}


