const submit_button = document.querySelector("button.sumbit")


let allFiles = []

const input_files = document.querySelector(".input-files")

function createBlob(file) {
  const blob = new Blob(file);
  // const link = window.URL.createObjectURL(blob);
  return blob;
}

function addAllFilesToInputValue() {
    // console.log(createBlob(allFiles));

  const dataTransfer = new DataTransfer();
  allFiles = [...new Set(allFiles)]

  allFiles.forEach((e, i) => {
    // console.log(allFiles[i]);
    dataTransfer.items.add(allFiles[i])
  });
  // console.log(dataTransfer.files)
  input_files.files = dataTransfer.files;
}

// input_files.addEventListener("change", e => {
//   test = createBlob([e.target.files[0]]);

//   for (const key in e.target.files) {
//     if (!["item", "length"].includes(key)) {
//       // allFiles.push(e.target.files[`${key}`]);
//       // allFiles.push(createBlob([file]));
//     }
//   }
// })

const dropArea = document.querySelector('.drop-area');

;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
  dropArea.addEventListener(eventName, preventDefaults, false)
})

function preventDefaults(e) {
  e.preventDefault()
  e.stopPropagation()
}

;['dragenter', 'dragover'].forEach(eventName => {
  dropArea.addEventListener(eventName, highlight, false)
})

  ;['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, unhighlight, false)
  })

function highlight(e) {
  dropArea.classList.add('highlight')
}

function unhighlight(e) {
  dropArea.classList.remove('highlight')
}

dropArea.addEventListener('drop', handleDrop, false)

function handleDrop(e) {
  const files = e.dataTransfer.files
  handleFiles(files)
}

function handleFiles(files) {
  ;[...files].forEach(previewFile)
}

function previewFile(file) {
  let reader = new FileReader()
  reader.readAsDataURL(file)
  reader.onloadend = () => {
    let img = document.createElement('img')
    img.src = reader.result
    document.querySelector('.temporary-gallery').appendChild(img)

    // test = createBlob([file])
    allFiles.push(file);
    // allFiles.push(createBlob([file]));
  }
}




$(".form-add-product").submit(e => { 
  e.preventDefault();

  const insert_confirmation = confirm("Data sudah lengkap?");
  if (!insert_confirmation) return
  
  submit_button.disabled = true;

  const product_code = document.querySelector(".product_code");
  product_code.removeAttribute("readonly");
  product_code.removeAttribute("disabled");
  addAllFilesToInputValue()
  const formData = new FormData(e.target);
  // console.log(test);
  // formData.append("blobs", test);
  
  
  $.ajax({
      type: "POST",
      url: window.location.pathname,
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: response => {
        const response = JSON.parse(response)
        if (response.result.success) {
          alert("Data berhasil ditambahkan. Terimakasih!")
          location.reload()
        }
      }
  });
})