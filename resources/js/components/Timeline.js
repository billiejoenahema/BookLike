import React, { useEffect, useState } from 'react'
import axios from 'axios'

function Timeline() {

    const [timelines, setTimelines] = useState([]);

    useEffect(() => {
        getTimelines()
    }, [])

    const getTimelines = async () => {
        const response = await axios.get('/api/reviews');
        setTimelines(response.data.timelines)
    }

    return (
        <div>
            {timelines.map((timeline) => <div className="card shadow-sm mb-3" key="{timeline.id}">{timeline.title}</div>)}
        </div>
    )
}

export default Timeline
