const userList = (searchWord) => {
    if (searchWord === null) {
        return users
    }
    return users.filter((item) => {
        return item.name.indexOf(searchWord) > -1
    })
    return users
}
