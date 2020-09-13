import React, { useEffect, useState, Fragment } from 'react'
import ReactDOM from 'react-dom'
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs'
import 'react-tabs/style/react-tabs.css';

import Timeline from './Timeline'
import Popular from './Popular'

const ReviewsTab = () => {
    const [timelines, setTimelines] = useState([])
    const [populars, setPopulars] = useState([])
    const [loginUser, setLoginUser] = useState([])

    useEffect(() => {
        getTimelines()
        getPopulars()
        getLoginUser()
    }, [])

    const getTimelines = async () => {
        const response = await axios.get('/api/reviews')
        setTimelines(response.data.timelines)
    }

    const getPopulars = async () => {
        const response = await axios.get('/api/reviews')
        setPopulars(response.data.populars)
    }

    const getLoginUser = async () => {
        const response = await axios.get('/api/reviews')
        setLoginUser(response.data.loginUser)
    }

    return (
        <Fragment>
            <Tabs>
                <TabList>
                    <Tab>タイムライン</Tab>
                    <Tab>人気の投稿</Tab>
                </TabList>
                <TabPanel>
                    <Timeline timelines={timelines} loginUser={loginUser} />
                </TabPanel>
                <TabPanel>
                    <Popular populars={populars} loginUser={loginUser} />
                </TabPanel>
            </Tabs>
        </Fragment>
    )

}


export default ReviewsTab

if (document.getElementById('reviewsTab')) {
    ReactDOM.render(<ReviewsTab />, document.getElementById('reviewsTab'))
}
