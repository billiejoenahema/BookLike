export const hideModal = () => {
  const searchModal = document.getElementById('searchModal')
  const modalBackdrop = document.getElementsByClassName('modal-backdrop')[0]
  const modalSearchButton = document.getElementById('modalSearchButton')

  // フォーカスを外す
  modalSearchButton.blur()
  body.classList.remove('modal-open')
  searchModal.classList.remove('show')
  searchModal.style.display = 'none'
  modalBackdrop.remove()
}
