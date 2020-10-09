const searchUsers = e => {

    setSearchWord(e.target.value)
    return allUsers.filter((item) => {
        return item.name.indexOf(searchWord) > -1
    })
}
