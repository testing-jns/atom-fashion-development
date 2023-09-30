const verify_responses = document.querySelector(".verify-responses");


document.addEventListener("DOMContentLoaded", () => {
    if (verify_responses.dataset.success === "false") {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: verify_responses.dataset.message,
            confirmButtonText: "BACK TO HOME"
        }).then(() => {
            setInterval(() => {
                location.href = "http://11sija1.smk2-yk.sch.id/Kelompok_2/atom-fashion"
            }, 200);
        })

        return
    }
    
    Swal.fire({
        icon: "success",
        title: "Verify success!",
        text: "Now you can login to your account!",
        confirmButtonText: "LOGIN"
    }).then(() => {
        setInterval(() => {
            location.href = "http://11sija1.smk2-yk.sch.id/Kelompok_2/atom-fashion/login"
        }, 200);
    })
});



