import React from 'react'
import ReactDOM from 'react-dom'
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs'
import '/Timeline'
import '/Popular'
import 'react-tabs/style/react-tabs.css';

export const ReviewsTab = () => {
    return (
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
    )
}

export default ReviewsTab
