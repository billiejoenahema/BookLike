import React, { useEffect, useState } from 'react'
import axios from 'axios'

function Popular() {

    const [populars, setPopulars] = useState([]);

    useEffect(() => {
        getPopulars()
    }, [])

    const getPopulars = async () => {
        const response = await axios.get('/api/reviews');
        setPopulars(response.data.populars)
    }

    return (
        <div>
            {populars.map((popular) => <div className="card shadow-sm mb-3" key="{popular.id}">{popular.title}</div>)}
        </div>
    )
}

export default Popular
