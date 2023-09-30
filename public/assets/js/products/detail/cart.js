function cartQuantityChangeValue() {
    const cart_quantity = document.querySelector(".count.cart-quantity")
    cart_quantity.textContent = parseInt(cart_quantity.textContent) + 1
}

function addToCart(code) {
    const xhr = new XMLHttpRequest();
    const url = "http://11sija1.smk2-yk.sch.id/Kelompok_2/atom-fashion/user/cart";

    let quantity = document.querySelector(".purchase-quantity");
    quantity = parseInt(quantity.textContent)


    const data = `code=${code}&quantity=${quantity}`
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
                title: "Success add to cart!",
            })
            
            cartQuantityChangeValue()
        }
    }

    xhr.send(data);
}