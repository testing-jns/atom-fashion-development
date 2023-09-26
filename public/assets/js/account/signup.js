const form = document.querySelector(".sign-up-form")
const email_field = form.querySelector(".email")
const allInputs = form.querySelectorAll("input")
const password = document.querySelector(".password")
const confirm_password = document.querySelector(".confirm_password")


document.addEventListener("DOMContentLoaded", () => {
  const google_auth_response = document.querySelector(".google-auth-response");

  if (google_auth_response.dataset.success === "") return;

  if (google_auth_response.dataset.success !== "true") {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: google_auth_response.dataset.message,
    }).then(() => {
      location.href = document.location.pathname
    });
    return
  }

  Swal.fire({
    icon: "success",
    title: "Success Sign Up!",
    html: `Please check your email <u>${email_field.value}</u>. Expires in 1 day. Thankyou!`
  }).then(() => {
    setInterval(() => {
      location.href = "/"
    }, 200);
  })

})

form.addEventListener("submit", e => {
  e.preventDefault()

  const is_filled = Array.from(allInputs).filter(input => input.value !== "");
  if (is_filled.length !== allInputs.length) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Please fill all fields!",
    })
    return
  }

  if (password.value !== confirm_password.value) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Password don't math!",
    })
    return
  }

  if (grecaptcha.getResponse().length === 0) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Please solve the recaptcha!",
    })
    return
  }


  const formData = new FormData(e.target)
  const xhr = new XMLHttpRequest();
  xhr.open("POST", document.location.pathname, true);

  Swal.fire({
    title: "Loading...",
    text: "Please wait a moment...",
    showConfirmButton: false
  })

  xhr.onreadystatechange = () => {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      const response = JSON.parse(xhr.response)

      if (!response.result.success) {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: response.result.error_mess,
        }).then(() => {
          setInterval(() => {
            location.href = document.location.pathname
          }, 200);
        })
        return
      };

      Swal.fire({
        icon: "success",
        title: "Success Sign Up!",
        html: `Please check your email <u>${email_field.value}</u>. Expires in 1 day. Thankyou!`
      }).then(() => {
        setInterval(() => {
          location.href = "/"
        }, 200);
      })

    }
  };

  xhr.send(formData);
})