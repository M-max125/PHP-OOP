const sign_in_btn = document.querySelector('#sign-in-btn');
const sign_up_btn = document.querySelector('#sign-up-btn');
const container = document.querySelector('.f-container');

sign_up_btn.addEventListener('click', () => {
    container.classList.add('sign-up-mode');
});

sign_in_btn.addEventListener('click', () => {
    container.classList.remove('sign-up-mode');
});

//Show pass when eye icon clicked
const pass_field = document.getElementsByClassName('pass');
const show_pass = document.getElementsByClassName('show');



for (i = 0; i < show_pass.length; i++) {
    show_pass[i].addEventListener('click', () => {
        for (i = 0; i < pass_field.length; i++) {
            if (pass_field[i].type === "password") {
                pass_field[i].type = "text";
                show_pass[i].style.color = "#3C0B9C";
            } else {
                pass_field[i].type = "password";
                show_pass[i].style.color = "var(--body-font-color)";
            }
        }
    });
}


  




