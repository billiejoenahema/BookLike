import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'
import Timeline from './Timeline'
import Users from './Users'
import ScrollTop from './ScrollTop'
import Loading from './Loading'
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs'
import 'react-tabs/style/react-tabs.css'

const UserPageTab = () => {

    const [loginUser, setLoginUser] = useState({})
    const [userReviews, setUserReviews] = useState([])
    const [favoriteReviews, setFavoriteReviews] = useState([])
    const [followingUsers, setFollowingUsers] = useState([])
    const [followedUsers, setFollowedUsers] = useState([])
    const [loading, setLoading] = useState(true)
    const currentUrl = window.location.pathname
    const storage = 'https://s3-ap-northeast-1.amazonaws.com/www.booklikeapp.com'
    const root = 'http://booklikeapp.com'

    useEffect(() => {
        const loadTab = async () => {
            setLoading(true)
            await axios
                .get(`/api${currentUrl}`)
                .then(res => {
                    setLoginUser(res.data.loginUser)
                    setUserReviews(res.data.userReviews)
                    setFavoriteReviews(res.data.favoriteReviews)
                    setFollowingUsers(res.data.followingUsers)
                    setFollowedUsers(res.data.followedUsers)
                })
                .catch(err => {
                    console.log(err)
                })
        }
        loadTab()
        setLoading(false)
    }, [])

    return (
        <>
            <Tabs>
                <TabList>
                    <Tab><div className="text-center small px-0">投稿<br />{userReviews.length}</div></Tab>
                    <Tab><div className="text-center small px-0">いいね<br />{favoriteReviews.length}</div></Tab>
                    <Tab><div className="text-center small px-0">フォロー中<br />{followingUsers.length}</div></Tab>
                    <Tab><div className="text-center small px-0">フォロワー<br />{followedUsers.length}</div></Tab>
                </TabList>
                <TabPanel>
                    {
                        userReviews.length !== 0 ?
                            <Timeline timelines={userReviews} loginUser={loginUser} storage={storage} root={root} />
                            : <div className="pb-5 my-5">投稿はまだありません</div>
                    }
                </TabPanel>
                <TabPanel>
                    {
                        favoriteReviews.length !== 0 ?
                            <Timeline timelines={favoriteReviews} loginUser={loginUser} storage={storage} root={root} />
                            : <div className="pb-5 my-5">いいねした投稿はまだありません</div>
                    }
                </TabPanel>
                <TabPanel>
                    {
                        followingUsers.length !== 0 ?
                            <Users users={followingUsers} loginUser={loginUser} storage={storage} root={root} />
                            : <div className="pb-5 my-5">フォローしているユーザーはまだいません</div>
                    }
                </TabPanel>
                <TabPanel>
                    {
                        followedUsers.length !== 0 ?
                            <Users users={followedUsers} loginUser={loginUser} storage={storage} root={root} />
                            : <div className="pb-5 my-5">フォロワーはまだいません</div>
                    }
                </TabPanel>
                {loading ? <Loading /> : <ScrollTop />}
            </Tabs>
        </>
    )
}

export default UserPageTab

if (document.getElementById('userPageTab')) {
    ReactDOM.render(<UserPageTab />, document.getElementById('userPageTab'))
}
