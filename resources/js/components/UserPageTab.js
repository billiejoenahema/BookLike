import React, { useEffect, useState, Fragment } from 'react'
import ReactDOM from 'react-dom'
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs'
import 'react-tabs/style/react-tabs.css';

import Timeline from './Timeline'

const UserPageTab = () => {

    const [loginUser, setLoginUser] = useState()
    const [userReviews, setUserReviews] = useState([])
    const [favoriteReviews, setFavoriteReviews] = useState([])
    const url = window.location.pathname

    useEffect(() => {
        getData()
    }, [])

    const getData = async () => {
        const response = await axios.get(`/api${url}`)
        setLoginUser(response.data.loginUser)
        setUserReviews(response.data.userReviews)
        setFavoriteReviews(response.data.favoriteReviews)
    }

    return (
        <Fragment>
            <Tabs>
                <TabList>
                    <Tab><div className="text-center">投稿</div></Tab>
                    <Tab><div className="text-center">いいねした投稿</div></Tab>
                    <Tab>フォロー</Tab>
                    <Tab>フォロワー</Tab>
                </TabList>
                <TabPanel>
                    <Timeline timelines={userReviews} loginUser={loginUser} />
                </TabPanel>
                <TabPanel>
                    <Timeline timelines={favoriteReviews} loginUser={loginUser} />
                </TabPanel>
                <TabPanel>
                    <Timeline timelines={userReviews} loginUser={loginUser} />
                </TabPanel>
                <TabPanel>
                    <Timeline timelines={userReviews} loginUser={loginUser} />
                </TabPanel>
            </Tabs>
        </Fragment>
    )

}

export default UserPageTab

if (document.getElementById('userPageTab')) {
    ReactDOM.render(<UserPageTab />, document.getElementById('userPageTab'))
}
