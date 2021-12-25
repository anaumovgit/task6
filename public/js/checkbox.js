let checkboxes = document.querySelectorAll('.form-check-input');
if (checkboxes.length !== 1) {
    let main_checkbox = document.querySelector('#flexCheckDefault');
    main_checkbox.onclick = function (event) {
        if (main_checkbox.checked) {
            for (let i = 1; i < checkboxes.length; i++) {
                checkboxes[i].checked = true;
                checkboxes[i].setAttribute('checked', 'checked');
            }
        } else {
            for (let i = 1; i < checkboxes.length; i++) {
                checkboxes[i].checked = false;
                checkboxes[i].removeAttribute('checked');
            }
        }
    }
}
