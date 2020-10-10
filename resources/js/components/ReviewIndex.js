import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import Timeline from './Timeline'

const ReviewIndex = () => {

    const [loginUser, setLoginUser] = useState()
    const [timelines, setTimelines] = useState([])
    const [searchWord, setSearchWord] = useState("")

    useEffect(() => {
        axios
            .get('/api/reviews')
            .then(res => {
                console.log(res)
                setLoginUser(res.data.loginUser)
                setTimelines(res.data.timelines)
            })
            .catch(err => {
                console.log(err)
            })
    }, [])

    const searchResults = timelines.filter((item) => {
        return item.title.indexOf(searchWord) > -1
    })

    const handleSearch = (e) => {
        setSearchWord(e.target.value)
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
            <Timeline timelines={searchResults} loginUser={loginUser} />
        </>
    )

}

export default ReviewIndex

if (document.getElementById('reviewIndex')) {
    ReactDOM.render(<ReviewIndex />, document.getElementById('reviewIndex'))
}
