function wishlistQuantityChangeValue() {
    const wishlist_quantity = document.querySelector(".count.wishlist-quantity")
    wishlist_quantity.textContent = parseInt(wishlist_quantity.textContent) + 1
}

function addToWishlist(code) {
    const xhr = new XMLHttpRequest();
    const url = "http://11sija1.smk2-yk.sch.id/Kelompok_2/atom-fashion/user/wishlist";

    const data = `code=${code}`
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            const response = JSON.parse(xhr.response)

            if (!response.results.success) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: response.results.error_mess,
                })
                return
            }

            Swal.fire({
                icon: "success",
                title: "Success add to wishlist!",
            })
            
            wishlistQuantityChangeValue()
        }
    }

    xhr.send(data);
}