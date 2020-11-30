function checkInputLoginForm() {
    'use strict'

    const email = document.getElementById('email')
    const password = document.getElementById('password')
    const login = document.getElementById('login')

    // emailとpasswordが入力されたらログインボタンを有効化する
    if ((email.value.indexOf('@') != -1) && password.value.length > 7) {
        login.classList.remove('disabled')
        login.disabled = false
    } else if (login.classList.contains('disabled') && login.disabled === false) {
        login.classList.add('disabled')
        login.disabled = true
    }
}
