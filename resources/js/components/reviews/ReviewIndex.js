import React, { useEffect, useState, useCallback } from 'react'
import ReactDOM from 'react-dom'
import Reviews from './Reviews'
import Loading from '../Loading'

const ReviewIndex = () => {

    const [loginUser, setLoginUser] = useState()
    const [reviews, setReviews] = useState([])
    const [category, setCategory] = useState('default')
    const [criteria, setCriteria] = useState('title')
    const [sort, setSort] = useState('default')
    const [page, setPage] = useState(1)
    const [hasMore, setHasMore] = useState(false)
    const [loading, setLoading] = useState(false)
    const [searchWord, setSearchWord] = useState('')

    useEffect(() => {
        const loadReviews = async () => {
            setLoading(true)
            const newReviews = await axios
                .get(`/api/reviews?criteria=${criteria}&search=${searchWord}&category=${category}&sort=${sort}&page=${page}`)
                .then(res => {
                    setLoginUser(res.data.loginUser)
                    page < res.data.reviews.last_page && setHasMore(true)
                    return res.data.reviews.data
                })
                .catch(err => {
                    console.log(err)
                })

            setReviews(prev => [...prev, ...newReviews])
            setLoading(false)
        }
        loadReviews()
    }, [page, category, searchWord, sort])

    // カテゴリー選択時にセレクトボックスを操作する
    const changeSelectBox = (selectedCategory) => {
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

        setReviews([])
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
        searchModal.style.display = 'none'
        searchModal.classList.remove('show')
        modalMapDrop.style.display = 'none'
        modalMapDrop.classList.remove('show')
        setReviews([])
        setPage(1)
        setHasMore(false)
        setSearchWord(modalSearchBooks.value)
    }

    // セレクトボックスを操作またはアンカーテキストをクリックしたときの処理
    const changeCategory = (e) => {
        const selectedValue = document.getElementById('categorySelector').value
        const clickedCategory = e.target.dataset.category
        const selectedCategory = clickedCategory || selectedValue

        // クリックしたカテゴリーが選択中のカテゴリーと同じならなにもしない
        if (clickedCategory === selectedValue) return

        changeSelectBox(selectedCategory)
        setReviews([])
        setCategory(selectedCategory)
        setPage(1)
        setHasMore(false)
    }

    // 一覧の並び替え
    const sortChange = useCallback(() => {
        const selectedSort = document.getElementById('selectSort').value
        setSort(selectedSort)
        setReviews([])
        setPage(1)
        setHasMore(false)
    })

    // 一定量スクロールしたら投稿をさらに読み込み(無限スクロール)
    const body = document.getElementById('body')
    body.onscroll = () => {
        const scrollAmount = window.scrollY
        const clientHeight = document.getElementById('reviewsComponent').clientHeight

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
            <div type="button" id="modalSearchButton" className="btn search-modal-button search-modal" data-toggle="modal" data-target="#searchModal">
                <i className="fas fa-search text-teal"></i>
            </div>

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

            <div id="search-word-display" className="mt-2">
                {searchWord && `検索ワード: \" ${searchWord}\ "`}
            </div>

            <div className="form-group d-flex flex-wrap justify-content-between mt-2 mb-0">
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
                        <option value="ratings">評価順</option>
                    </select>
                </div>
            </div>

            {/* 投稿一覧 */}
            <div id="reviewsComponent">
                <Reviews reviews={reviews} loginUser={loginUser} changeCategory={changeCategory} />
            </div>

            {/* Loading Spinner */}
            <div className="text-center">
                {loading && < Loading />}
                {!loading && (reviews.length === 0) && '該当する投稿は見つかりませんでした'}
            </div>
        </>
    )
}

export default ReviewIndex

if (document.getElementById('reviewIndex')) {
    ReactDOM.render(<ReviewIndex />, document.getElementById('reviewIndex'))
}


