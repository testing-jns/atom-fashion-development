
  const form = document.querySelector("form.form-add-product"),
    nextBtn = form.querySelector(".nextBtn"),
    backBtn = form.querySelector(".backBtn"),
    allInput = form.querySelectorAll(".first input"),
    allInputOptions = form.querySelectorAll("select"),
    textArea = form.querySelector("textarea");


  nextBtn.addEventListener("click", e => {
    const unselected_inputs_options = Array.from(allInputOptions).filter(e => {
      const options_value = Array.from(e.options).map(e => {
        if (e.disabled) return e.value;
      });

      const is_not_changed = e.value === options_value[0];

      e.style.border = is_not_changed ? "3px solid red" : "1px solid black";

      return is_not_changed;
    })

    // textArea.value = textArea.value.replace(/\s/g, "");
    // || textArea.value == ""

    if (unselected_inputs_options.length !== 0) {
      e.preventDefault();
      return;
    }


    const input_isset = Array.from(allInput).filter(input => {
      return input.value !== "";
    })



    if (input_isset.length !== allInput.length) {
      form.classList.remove('secActive');
      return;
    }

    e.preventDefault()
    form.classList.add('secActive');
  })

  backBtn.addEventListener("click", () => form.classList.remove('secActive'));

