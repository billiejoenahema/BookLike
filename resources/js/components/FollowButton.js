import { useState, useCallback } from 'react'

const FollowButton = (props) => {

    const InitialState = props.isFollowing
    const user_id = props.id


    const [following, setFollowing] = useState(InitialState)
    const toggleFollow = useCallback(() => setFollowing((prev) => !prev), [setFollowing])

    const FollowButton = () => {
        toggleFollow()
        console.log('FollowButton Clicked!')

        return axios.post(`http://127.0.0.1:8000/api/${user_id}/unfollow`)
            .then(res => {
                console.log('Success!')
                console.log(user_id)
            })
            .catch(err => {
                console.log('Failure!')
            })
    }

    const UnFollowButton = () => {
        toggleFollow()
        console.log('UnFollowButton Clicked!')

        return axios.delete(`http://127.0.0.1:8000/api/${user_id}/follow`)
            .then(res => {
                console.log('Success!')
                console.log(res.data)
            })
            .catch(err => {
                console.log('Failure!')
            })
    }

    return (
        <>
            <button onClick={following ? UnFollowButton() : FollowButton()} className="btn-sm btn-primary shadow-sm rounded-pill" >
                <i className={following ? "btn-sm btn-primary shadow-sm rounded-pill" : "btn-sm btn-outline-primary shadow-sm rounded-pill"}></i>
            </button >
        </>
    )
}

export default FollowButton
