import React, { useEffect, useState, Fragment } from 'react'
import ReactDOM from 'react-dom'
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs'
import 'react-tabs/style/react-tabs.css';

import Timeline from './Timeline'

const MyPageTab = () => {

    const [loginUser, setLoginUser] = useState()
    const [myReviews, setMyReviews] = useState([])
    const [favoriteReviews, setFavoriteReviews] = useState([])
    const url = window.location.pathname

    useEffect(() => {
        getData()
    }, [])

    const getData = async () => {
        const response = await axios.get(`/api${url}`)
        setLoginUser(response.data.loginUser)
        setMyReviews(response.data.myReviews)
        setFavoriteReviews(response.data.favoriteReviews)
    }

    return (
        <Fragment>
            <Tabs>
                <TabList>
                    <Tab><div className="text-center small">投稿</div></Tab>
                    <Tab><div className="text-center small">いいねした投稿</div></Tab>
                    <Tab><div className="text-center small">フォロー</div></Tab>
                    <Tab><div className="text-center small">フォロワー</div></Tab>
                </TabList>
                <TabPanel>
                    <Timeline timelines={myReviews} loginUser={loginUser} />
                </TabPanel>
                <TabPanel>
                    <Timeline timelines={favoriteReviews} loginUser={loginUser} />
                </TabPanel>
                <TabPanel>
                    <Timeline timelines={myReviews} loginUser={loginUser} />
                </TabPanel>
                <TabPanel>
                    <Timeline timelines={myReviews} loginUser={loginUser} />
                </TabPanel>
            </Tabs>
        </Fragment>
    )

}

export default MyPageTab

if (document.getElementById('mypageTab')) {
    ReactDOM.render(<MyPageTab />, document.getElementById('mypageTab'))
}
