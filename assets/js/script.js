const password = document.getElementById('password');
const pass_confirm = document.getElementById('pass_confirm');
const toggle = document.getElementById('toggle');
const toggleConfirm = document.getElementById('toggleConfirm');

function showHidePassword(){
    if(password.type === 'password'){
        password.setAttribute('type', 'text');
        toggle.classList.add('hide')
    } else{
        password.setAttribute('type', 'password');
        toggle.classList.remove('hide')
    }
}

function showHidePassConfirm(){
    if(pass_confirm.type === 'password'){
        pass_confirm.setAttribute('type', 'text');
        toggleConfirm.classList.add('hide')
    } else{
        pass_confirm.setAttribute('type', 'password');
        toggleConfirm.classList.remove('hide')
    }
}