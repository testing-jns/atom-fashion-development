const form = document.querySelector(".sign-in-form")
const allInputs = form.querySelectorAll("input")


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
    title: "Login Success!",
    text: `Welcome ${google_auth_response.dataset.email}!`,
    confirmButtonText: "Dashboard"
  }).then(() => {
    setInterval(() => {
      location.href = "/user/settings"
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
        })
        return
      };

      Swal.fire({
        icon: "success",
        title: "Login Success!",
      }).then(() => {
        setInterval(() => {
          location.href = "/user/settings"
        }, 200);
      })

    }
  };

  xhr.send(formData);
})