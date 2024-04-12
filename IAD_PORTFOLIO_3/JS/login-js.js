document.addEventListener('DOMContentLoaded', function() {
    let submit = document.getElementById("reg-popup");
    submit.addEventListener("click", function(){
        let dis = document.getElementById("reg");
        dis.style.display = 'block';
    });
  
    let hide = document.getElementById('hide');
    hide.addEventListener("click", function(){
        let dis = document.getElementById("reg");
        dis.style.display = 'none';
    });

    let register = document.getElementById("register");
    register.addEventListener("click", function(){
        validateEmail();
        sameEmail();
        samePass();
        passLength();
        userLength();
    });
  });

function validateEmail() {
    let mail = document.getElementById("email");
    let regex = /^([a-zA-Z0-9\._]+)@([a-zA-Z0-9])+\.([a-z]+)(\.[a-z]+)?$/;
    
    if (regex.test(mail.value)) {
        mail.setCustomValidity("");
        return true;
    } else {
        mail.setCustomValidity("Invalid Email Address!");
        return false;
    }
}

function sameEmail(){
    let mail = document.getElementById("email");
    let confirm_mail = document.getElementById("confirm-email");

    if(mail.value === confirm_mail.value){
        confirm_mail.setCustomValidity("");
        return true;
    }
    else{
        confirm_mail.setCustomValidity("Emails do not match!");
        return false;
    }
}

function samePass(){
    let pass = document.getElementById("pass");
    let confirm_pass = document.getElementById("con-pass");

    if(pass.value === confirm_pass.value){
        confirm_pass.setCustomValidity("");
        return true;
    }
    else{
        confirm_pass.setCustomValidity("Passwords do not match!");
        return false;
    }
}

function passLength(){
    let password = document.getElementById("pass");

    if(password.value.length >= 8){
        password.setCustomValidity("");
        return true;
    }
    else{
        password.setCustomValidity("Passwords must be atleast 8 characters long!");
        return false;
    }
}

function userLength(){
    let user = document.getElementById("usern");

    if(user.value.length >= 6){
        user.setCustomValidity("");
        return true;
    }
    else{
        user.setCustomValidity("Usernames must be atleast 6 characters long!");
        return false;
    }
}