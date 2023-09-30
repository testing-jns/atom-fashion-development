const forms = document.querySelector(".forms"),
      pwShowHide = document.querySelectorAll(".eye-icon"),
      links = document.querySelectorAll(".link");

pwShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");
        
        pwFields.forEach(password => {
            if(password.type === "password"){
                password.type = "text";
                eyeIcon.classList.replace("bx-hide", "bx-show");
                return;
            }
            password.type = "password";
            eyeIcon.classList.replace("bx-show", "bx-hide");
        })
        
    })
})      




const quick_login_popup = document.querySelector(".quick_login_popup");

function quick_login() {
  quick_login_popup.classList.add("active")
}

function close_button() {
  quick_login_popup.classList.remove("active")
}



// links.forEach(link => {
//     link.addEventListener("click", e => {
//        e.preventDefault(); //preventing form submit
//        forms.classList.toggle("show-signup");
//     })
// })