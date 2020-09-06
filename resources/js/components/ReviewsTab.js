import React, { Fragment } from 'react'
import ReactDOM from 'react-dom'
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs'
import 'react-tabs/style/react-tabs.css';

import Timeline from './Timeline'
import Popular from './Popular'

const ReviewsTab = () => {
    return (
        <Fragment>
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
