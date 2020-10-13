window.onload = () => {
    const select = document.getElementById('editCategory')
    if (select) {
        const options = select.options
        const category = document.getElementById('editCategory').dataset.category

        for (let i = 0; i < options.length; i++) {
            if (options[i].value === category) {
                options[i].selected = true;
                break;
            }
        }
    }
}
