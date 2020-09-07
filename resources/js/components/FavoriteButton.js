import React, { useState, useEffect, useCallback } from "react"
import ReactTooltip from 'react-tooltip'

const FavoriteButton = () => {

    const [isFavo, setFavo] = useState(false);
    const toggleFavo = useCallback(() => setFavo((prev) => !prev), [setFavo])

    return (
        <button onClick={toggleFavo} className="btn p-0 border-0">
            {
                isFavo ? <i class="fas fa-heart text-danger"></i>
                    : <i class="far fa-heart text-primary"></i>
            }
        </button>
    )
}



export default FavoriteButton
