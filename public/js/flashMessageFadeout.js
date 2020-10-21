const flashMessage = document.getElementById('flashMessage')
if (flashMessage) {
    window.onload = () => {
        flashMessage.classList.add('fadeout')
    }
}
