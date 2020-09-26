import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs'
import 'react-tabs/style/react-tabs.css';

import Timeline from './Timeline'

const ReviewsTab = () => {

    const [loginUser, setLoginUser] = useState()
    const [timelines, setTimelines] = useState([])
    const [populars, setPopulars] = useState([])

    useEffect(() => {
        axios
            .get('/api/reviews')
            .then(res => {
                console.log(res)
                setLoginUser(res.data.loginUser)
                setTimelines(res.data.timelines)
                setPopulars(res.data.populars)
            })
            .catch(err => {
                console.log(err)
            })
    }, [])

    // const getData = async () => {
    //     const response = await axios.get('/api/reviews')
    //     setLoginUser(response.data.loginUser)
    //     setTimelines(response.data.timelines)
    //     setPopulars(response.data.populars)
    // }

    return (
        <Tabs>
            <TabList>
                <Tab>タイムライン</Tab>
                <Tab>人気の投稿</Tab>
            </TabList>
            <TabPanel>
                <Timeline timelines={timelines} loginUser={loginUser} />
            </TabPanel>
            <TabPanel>
                <Timeline timelines={populars} loginUser={loginUser} />
            </TabPanel>
        </Tabs>
    )

}


export default ReviewsTab

if (document.getElementById('reviewsTab')) {
    ReactDOM.render(<ReviewsTab />, document.getElementById('reviewsTab'))
}
