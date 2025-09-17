// const passwordField = document.querySelector(".form input[type='password']"),
const passwordField = document.getElementById('pass'),
cpasswordField = document.getElementById('cpass'),
toggleBtn = document.querySelector(".form .field #eye"),
ctoggleBtn = document.querySelector(".form .field #ceye");

toggleBtn.onclick = ()=>{
    if(passwordField.type == "password"){
        passwordField.type = "text";
        toggleBtn.classList.add("active");
    }
    else{
        passwordField.type = "password";
        toggleBtn.classList.remove("active");
    }
}

ctoggleBtn.onclick = ()=>{
    if(cpasswordField.type == "password"){
        cpasswordField.type = "text";
        ctoggleBtn.classList.add("active");
    }
    else{
        cpasswordField.type = "password";
        ctoggleBtn.classList.remove("active");
    }
}