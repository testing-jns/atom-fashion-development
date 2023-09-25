const form  = document.querySelector(".sign-in-form")
const allInputs = form.querySelectorAll("input")

form.addEventListener("submit", e => {
  e.preventDefault()

  const is_filled = Array.from(allInputs).filter(input => input.value !== "");
  if (is_filled.length !== allInputs.length) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Please insert all fields!",
    })
    return
  }

  e.target.submit()
})