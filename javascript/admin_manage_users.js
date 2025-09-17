const form = document.querySelector(".update form"),
continueBtn = document.querySelector(".update form input[type='submit']"),
errorText = document.querySelector(".update .error-text");

form.onsubmit = (e)=>{
    e.preventDefault(); // Preventing form from submitting
}

continueBtn.onclick = ()=>{
    // Ajax Starts
    let xhr = new XMLHttpRequest(); // Creating XML Object
    xhr.open("POST", "../php/amu_script.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                // console.log(data);
                errorText.style.display = "block";
                errorText.textContent = data;
                if(data === 'Success!'){
                    errorText.style.color = "#388E3C";
                    errorText.style.background = "#BBF7D0";
                    errorText.style.border = "1px solid #9effc0";
                    errorText.textContent = "User updated successfully!";
                    setTimeout(()=>{
                        window.location.href = "admin_users.php";
                    }, 2000);
                }
            }
        }
    }
    // We have to send the form through ajax to php
    let formData = new FormData(form); // Creating new formData Object
    xhr.send(formData); // Sending the form data to php
}