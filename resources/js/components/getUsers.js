import axios from 'axios'

export const getUsers = () => {

    axios
        .get('/api/users', { data: searchWord })
        .then(res => {
            console.log(res)
            setLoginUser(res.data.loginUser)
            setAllUsers(res.data.users)
        })
        .catch(err => {
            console.log(err)
        })
}
