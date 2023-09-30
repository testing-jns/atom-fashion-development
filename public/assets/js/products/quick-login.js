const form = document.querySelector(".form-quick-login")
const allInputs = form.querySelectorAll("input")



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
  xhr.open("POST", "http://11sija1.smk2-yk.sch.id/Kelompok_2/atom-fashion/login", true);

  Swal.fire({
    title: "Loading...",
    text: "Please wait a moment...",
    showConfirmButton: false
  })

  xhr.onreadystatechange = () => {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      const response = JSON.parse(xhr.response)

      if (!response.results.success) {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: response.results.error_mess,
        })
        return
      };

      Swal.fire({
        icon: "success",
        title: "Login Success!",
      }).then(() => {
        setInterval(() => {
          location.href = "http://11sija1.smk2-yk.sch.id/Kelompok_2/atom-fashion"
        }, 200);
      })

    }
  };

  xhr.send(formData);
})