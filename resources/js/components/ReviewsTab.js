import React, { Fragment } from 'react'
import ReactDOM from 'react-dom'
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs'
import './Timeline'
import './Popular'
import 'react-tabs/style/react-tabs.css';

const ReviewsTab = () => {
    return (
        <Fragment>
            <h2>ReviewsTab</h2>
            <Tabs>
                <TabList>
                    <Tab>タイムライン</Tab>
                    <Tab>人気の投稿</Tab>
                </TabList>
                <TabPanel>
                    <Timeline />
                </TabPanel>
                <TabPanel>
                    <Popular />
                </TabPanel>
            </Tabs>
        </Fragment>
    )
}

export default ReviewsTab

if (document.getElementById('reviewsTab')) {
    ReactDOM.render(<ReviewsTab />, document.getElementById('reviewsTab'))
}
