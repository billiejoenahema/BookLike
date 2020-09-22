import React, { useEffect, useState, Fragment } from 'react'
import ReactDOM from 'react-dom'
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs'
import 'react-tabs/style/react-tabs.css';


import Timeline from './Timeline'
import Users from './Users'

const UserPageTab = () => {

    const [loginUser, setLoginUser] = useState()
    const [followingUsers, setFollowingUsers] = useState([])
    const [followers, setFollowers] = useState([])
    const [userReviews, setUserReviews] = useState([])
    const [favoriteReviews, setFavoriteReviews] = useState([])
    const url = window.location.pathname

    useEffect(() => {
        getData()
    }, [])

    const getData = async () => {
        const response = await axios.get(`/api${url}`)
        setLoginUser(response.data.loginUser)
        setFollowingUsers(response.data.followingUsers)
        setFollowers(response.data.followers)
        setUserReviews(response.data.userReviews)
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
                    <Timeline timelines={userReviews} loginUser={loginUser} />
                </TabPanel>
                <TabPanel>
                    <Timeline timelines={favoriteReviews} loginUser={loginUser} />
                </TabPanel>
                <TabPanel>
                    <Users users={followingUsers} loginUser={loginUser} />
                </TabPanel>
                <TabPanel>
                    <Users users={followers} loginUser={loginUser} />
                </TabPanel>
            </Tabs>
        </Fragment>
    )
}

export default UserPageTab

if (document.getElementById('userPageTab')) {
    ReactDOM.render(<UserPageTab />, document.getElementById('userPageTab'))
}
