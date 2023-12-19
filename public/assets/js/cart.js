document.addEventListener("DOMContentLoaded", function () {
    const addToCartButtons = document.querySelectorAll(".product-cart");
    updateCartView();

    addToCartButtons.forEach((button) => {
        button.addEventListener("click", async function (e) {
            e.preventDefault();
            const productId = this.getAttribute("data-id");
            const productName = this.getAttribute("data-name");
            const productPrice = this.getAttribute("data-price");
            const productFinalPrice = this.getAttribute("data-finalprice");
            const productImage = this.getAttribute("data-image");
            const hasPromotion = this.getAttribute("data-promocion") === "si";

            try {
                await addToCart(
                    productId,
                    productName,
                    productPrice,
                    productFinalPrice,
                    productImage,
                    hasPromotion
                );
                updateCartView();
                toastr.success("Producto añadido al carrito.");
            } catch (error) {
                toastr.error("Error al procesar la solicitud.");
            }
        });
    });
});

async function addToCart(
    productId,
    productName,
    productPrice,
    productFinalPrice,
    productImage,
    hasPromotion
) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let found = cart.find((p) => p.id === productId);
    if (found) {
        found.quantity += 1;
    } else {
        cart.push({
            id: productId,
            name: productName,
            price: productPrice,
            finalPrice: productFinalPrice,
            image: productImage,
            promotion: hasPromotion,
            quantity: 1,
        });
    }
    localStorage.setItem("cart", JSON.stringify(cart));
}

function updateCartView() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    const cartItemsElement = document.querySelector("#cart-items");
    const cartItemCountElement = document.querySelector("#cart-item-count");
    let total = 0;

    cartItemsElement.innerHTML = "";
    cartItemCountElement.textContent = cart.length;

    cart.forEach((item) => {
        total += parseFloat(item.finalPrice) * item.quantity;
        const itemElement = document.createElement("div");
        itemElement.classList.add("single-cart-item");
        itemElement.innerHTML = `
            <div class="cart-img">
                <a href="cart.html"><img src="${item.image}" alt="${item.name}"></a>
            </div>
            <div class="cart-text">
                <h5 class="title">${item.name}</h5>
                <div class="cart-text-btn">
                    <div class="cart-qty">
                        <span>${item.quantity}×</span>
                        <span class="cart-price">${item.finalPrice}</span>
                    </div>
                </div>
            </div>`;

        const deleteButton = document.createElement("button");
        deleteButton.type = "button";
        deleteButton.textContent = "Eliminar"; 
        deleteButton.addEventListener("click", function () {
            removeItemFromCart(item.id);
        });
        itemElement.appendChild(deleteButton);

        cartItemsElement.appendChild(itemElement);
    });

    const totalElement = document.createElement("h5");
    totalElement.textContent = `Total: Bs. ${total.toFixed(2)}`;
    cartItemsElement.appendChild(totalElement);

    const cartLinksElement = document.createElement("div");
    cartLinksElement.classList.add(
        "cart-links",
        "d-flex",
        "justify-content-between"
    );
    cartLinksElement.innerHTML = `
    <a class="btn product-cart button-icon flosun-button dark-btn" href="#" onclick="verCarrito()">Ver carrito</a>`;
    cartItemsElement.appendChild(cartLinksElement);
}

function removeItemFromCart(productId) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    cart = cart.filter((item) => item.id !== productId);
    localStorage.setItem("cart", JSON.stringify(cart));
    updateCartView();
    console.log(productId);
}

function verCarrito() {
    let carrito = localStorage.getItem("cart");
    if (carrito) {
        let carritoEncoded = encodeURIComponent(carrito);

        window.location.href = `/inf513/grupo14sa/JubolSrl-Web/public/cart?cart=${carritoEncoded}`;
    }
}
