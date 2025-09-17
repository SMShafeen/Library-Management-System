const form = document.querySelector(".add-books form"),
continueBtn = document.querySelector(".add-books form input[type='submit']"),
errorText = document.querySelector(".add-books .error-text"),
updateForm = document.querySelector(".update form"),
updateContinueBtn = document.querySelector(".update form input[type='submit']"),
updateErrorText = document.querySelector(".update .error-text");

form.onsubmit = (e)=>{
    e.preventDefault(); // Preventing form from submitting
}

continueBtn.onclick = ()=>{
    // Ajax Starts
    let xhr = new XMLHttpRequest(); // Creating XML Object
    xhr.open("POST", "../php/amb_script.php", true);
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
                    errorText.textContent = "Book added successfully!";
                    setTimeout(()=>{
                        window.location.href = "admin_manage_books.php";
                    }, 2000);
                }
            }
        }
    }
    // We have to send the form through ajax to php
    let formData = new FormData(form); // Creating new formData Object
    xhr.send(formData); // Sending the form data to php
}

updateContinueBtn.onclick = ()=>{
    // Ajax Starts
    let xhr_update = new XMLHttpRequest(); // Creating XML Object
    xhr_update.open("POST", "../php/amb_script2.php", true);
    xhr_update.onload = ()=>{
        if(xhr_update.readyState === XMLHttpRequest.DONE){
            if(xhr_update.status === 200){
                let updateData = xhr_update.response;
                // console.log(updateData);
                updateErrorText.style.display = "block";
                updateErrorText.textContent = updateData;
                if(updateData === 'Success!'){
                    updateErrorText.style.color = "#388E3C";
                    updateErrorText.style.background = "#BBF7D0";
                    updateErrorText.style.border = "1px solid #9effc0";
                    updateErrorText.textContent = "Book updated successfully!";
                    window.location.href = "admin_manage_books.php";
                    // setTimeout(()=>{
                    // }, 2000);
                }
            }
        }
    }
    // We have to send the form through ajax to php
    let updateFormData = new FormData(updateForm); // Creating new formData Object
    xhr_update.send(updateFormData); // Sending the form data to php
}