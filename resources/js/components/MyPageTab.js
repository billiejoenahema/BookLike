import React, { useEffect, useState, Fragment } from 'react'
import ReactDOM from 'react-dom'
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs'
import 'react-tabs/style/react-tabs.css';

import Timeline from './Timeline'

const MyPageTab = () => {

    const [loginUser, setLoginUser] = useState()
    const [myReviews, setMyReviews] = useState([])

    useEffect(() => {
        getData()
    }, [])

    const getData = async () => {
        const response = await axios.get('/api/users')
        setLoginUser(response.data.loginUser)
        setMyReviews(response.data.myReviews)
    }

    return (
        <Fragment>
            <Tabs>
                <TabList>
                    <Tab>自分の投稿</Tab>
                    <Tab>いいねした投稿</Tab>
                    <Tab>フォロー</Tab>
                    <Tab>フォロワー</Tab>
                </TabList>
                <TabPanel>
                    <Timeline timelines={myReviews} loginUser={loginUser} />
                </TabPanel>
                <TabPanel>
                    <Timeline timelines={myReviews} loginUser={loginUser} />
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
