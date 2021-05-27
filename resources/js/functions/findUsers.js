export const findUsers = (name, searchWord) => {
  return name.toLowerCase().indexOf(searchWord.toLowerCase()) > -1
}
