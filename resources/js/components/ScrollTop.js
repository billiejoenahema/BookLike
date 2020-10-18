import React from 'react'

export default function ScrollTop() {
    const scrollTop = () => {
        'use strict'
        let y = document.body.scrollTop || document.documentElement.scrollTop
        if (y) {
            scrollTo(0, y /= 1.06)
        }
        return
    }
    return (
        <div className="text-center text-blog scroll-top d-flex justify-content-center m-5">
            <a href="#" onClick={scrollTop} className="text-blog mb-0">
                <i className="fas fa-angle-up h1"></i>
                <br />
                <span>Page Top</span>
            </a>
        </div>
    )
}
