const form = document.querySelector(".signup form"),
continueBtn = document.querySelector(".button input"),
errorText = document.querySelector(".error-text");

form.onsubmit = (e)=>{
    e.preventDefault(); // Preventing form from submitting
}

continueBtn.onclick = ()=>{
    // Ajax Starts
    let xhr = new XMLHttpRequest(); // Creating XML Object
    xhr.open("POST", "../php/signupscript.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                // console.log(data);
                if(data === 'Success!'){
                    location.href = 'login.php';
                }else{
                    errorText.style.display = "block";
                    errorText.textContent = data;
                }
            }
        }
    }
    // We have to send the form through ajax to php
    let formData = new FormData(form); // Creating new formData Object
    xhr.send(formData); // Sending the form data to php
}