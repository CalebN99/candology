// Candology
// Script to display confirmation button in admin table when updating quantity

// Get inputs
const quantityInputs = document.getElementsByClassName('product-qty');


for (let i = 0; i < quantityInputs.length; i++) {
    quantityInputs[i].addEventListener('change', function() {
        const parent = quantityInputs[i].parentNode

        if (parent.lastElementChild === this) {
            // Create button for submission
            const buttonDiv = document.createElement("div");
            buttonDiv.classList.add("input-group-append");

            const button = document.createElement('button');

            // Add onclick functionality to button
            // Update product quantity in database
            $(button).on('click', function() {
                const input = quantityInputs[i];

                $('#message').load("admin-quantity-update", {qty: input.value, productId: input.name});

                setTimeout(function(){
                    $('.toast').toast('show');
                    console.log(document.querySelector(".toast-header"));
                    if (document.querySelector(".toast-header").innerText === "Success") {
                        parent.removeChild(buttonDiv);
                    }
                }, 1000);
            });

            // Add classes (styles) to button
            button.classList.add("btn");
            button.classList.add("bg-success");

            // Append button to button div
            buttonDiv.appendChild(button);

            // Append button/div as sibling element to input
            parent.appendChild(buttonDiv);
        }
    });
    // quantityInputs[i].onblur = function() {
    //     // Append button/div as sibling element to input
    //     const parent = quantityInputs[i].parentNode;
    //
    //     parent.removeChild(parent.lastElementChild);
    // };
}