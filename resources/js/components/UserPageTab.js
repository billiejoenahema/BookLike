import React, { useEffect, useState, Fragment } from 'react'
import ReactDOM from 'react-dom'
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs'
import axios from 'axios'
import 'react-tabs/style/react-tabs.css'

import Timeline from './Timeline'
import Users from './Users'

const UserPageTab = () => {

    const [loginUser, setLoginUser] = useState()
    const [userReviews, setUserReviews] = useState([])
    const [favoriteReviews, setFavoriteReviews] = useState([])
    const [followingUsers, setFollowingUsers] = useState([])
    const [followedUsers, setFollowedUsers] = useState([])
    const url = window.location.pathname

    useEffect(() => {
        getData()
    }, [])

    const getData = async () => {
        const response = await axios.get(`/api${url}`)
        setLoginUser(response.data.loginUser)
        setUserReviews(response.data.userReviews)
        setFavoriteReviews(response.data.favoriteReviews)
        setFollowingUsers(response.data.followingUsers)
        setFollowedUsers(response.data.followedUsers)
    }

    function existsData(array) {
        return array.length !== 0
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
                    {
                        existsData(userReviews) ? <Timeline timelines={userReviews} loginUser={loginUser} /> : <div className="pb-5 mb-5">投稿はまだありません</div>
                    }
                </TabPanel>
                <TabPanel>
                    {
                        existsData(favoriteReviews) ? <Timeline timelines={favoriteReviews} loginUser={loginUser} /> : <div className="pb-5 mb-5">いいねした投稿はまだありません</div>
                    }
                </TabPanel>
                <TabPanel>
                    {
                        existsData(followingUsers) ? <Users users={followingUsers} loginUser={loginUser} /> : <div className="pb-5 mb-5">フォローしているユーザーはまだいません</div>
                    }
                </TabPanel>
                <TabPanel>
                    {
                        existsData(followedUsers) ? <Users users={followedUsers} loginUser={loginUser} /> : <div className="pb-5 mb-5">フォロワーはまだいません</div>
                    }
                </TabPanel>
            </Tabs>
        </Fragment>
    )
}

export default UserPageTab

if (document.getElementById('userPageTab')) {
    ReactDOM.render(<UserPageTab />, document.getElementById('userPageTab'))
}
