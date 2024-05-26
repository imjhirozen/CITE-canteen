loadData();
document.querySelector('#btn-food').addEventListener('click', e => {
    removeDOM();
    loadData();
    
});

document.querySelector('#btn-drink').addEventListener('click', e => {
    removeDOM();
    loadData('DRINK');  
});

document.querySelector('#btn-dessert').addEventListener('click', e => {
    removeDOM();
    loadData('DESSERT');
    
});

document.querySelector('#btn-snack').addEventListener('click', e => {
    removeDOM();
    loadData('SNACK');
    
});

try {
    document.querySelector('#btn-admin').addEventListener('click', e => {
        location.href = '/index.php/admin';
        
    });
}catch (error) {
    console.error("Error adding event listener:", error);
}


document.querySelector('#btn-logout').addEventListener('click', e => {
    location.href = '/index.php/destroy';
    
});


/* 
    Create product
*/

function loadJSON(file, callback) {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Parse the JSON response and call the callback with the parsed data
            callback(JSON.parse(xhr.responseText));
        }
    };

    xhr.open('GET', file, true);
    xhr.send();
}

// Function to create and append the product HTML
function appendProductToMain(product) {
    // Create main container div
    const itemMenuDiv = document.createElement("div");
    itemMenuDiv.classList.add("itemMenu");

    // Create image container div
    const imgContainerDiv = document.createElement("div");
    imgContainerDiv.classList.add("imgContainer");

    // Create image element
    const imgElement = document.createElement("img");
    imgElement.setAttribute("src", product.product_image);
    imgElement.setAttribute("alt", product.product_name);
    imgElement.classList.add("fitCover");

    // Create item name div
    const descriptionDiv = document.createElement("div");
    descriptionDiv.classList.add("food_info");

    // Create product name heading
    const productNameHeading = document.createElement("span");
    productNameHeading.style.padding = '2px';
    productNameHeading.setAttribute("id", "product_name");
    productNameHeading.textContent = product.product_name;
    productNameHeading.classList.add("item_name");

    // Create product price span
    const productPriceSpan = document.createElement("span");
    productPriceSpan.setAttribute("id", "product_price");
    productPriceSpan.textContent = product.product_price;
    productPriceSpan.classList.add("product_price");

    

    // Append image, item name div to image container div
    imgContainerDiv.appendChild(imgElement);

    // Create order container div
    const orderContainerDiv = document.createElement("div");
    orderContainerDiv.classList.add("orderContainer");

    // Create quantity panel div
    const quantityPanelDiv = document.createElement("div");
    quantityPanelDiv.setAttribute("id", "action");
    quantityPanelDiv.classList.add("quantityPanel");

    // Create decrement button
    const decrementButton = document.createElement("button");
    decrementButton.setAttribute("id", "decrement_button");
    decrementButton.textContent = "-";

    // Create product quantity div
    const productQuantityDiv = document.createElement("div");
    productQuantityDiv.setAttribute("id", "product_quantity");
    productQuantityDiv.classList.add("amount");
    productQuantityDiv.textContent = "0";

    // Create increment button
    const incrementButton = document.createElement("button");
    incrementButton.setAttribute("id", "increment_button");
    incrementButton.textContent = "+";

    // Append product name and price to item name div
    descriptionDiv.appendChild(productNameHeading);
    descriptionDiv.appendChild(productPriceSpan);

    // Append buttons and product quantity to quantity panel div
    quantityPanelDiv.appendChild(decrementButton);
    quantityPanelDiv.appendChild(productQuantityDiv);
    quantityPanelDiv.appendChild(incrementButton);

    // Create add button
    const addButton = document.createElement("button");
    addButton.style.padding = '10px';
    addButton.setAttribute("id", "add_product_orderpanel");
    addButton.classList.add("placeOrder");
    addButton.textContent = "ADD";

    // Append quantity panel and add button to order container div
    orderContainerDiv.appendChild(quantityPanelDiv);
    orderContainerDiv.appendChild(addButton);

    // Append image container and order container to main container div
    itemMenuDiv.appendChild(imgContainerDiv);
    itemMenuDiv.appendChild(descriptionDiv);
    itemMenuDiv.appendChild(orderContainerDiv);

    // Append main container div to the document body or any other desired parent element
    document.querySelector('main').appendChild(itemMenuDiv);


    decrementButton.addEventListener('click', () => {
        buttonDecrement(productQuantityDiv);
    });

    incrementButton.addEventListener('click', () => {
        buttonIncrement(productQuantityDiv);
    });

    addButton.addEventListener('click', () => {
        addProductToOrderPanel(productNameHeading, productQuantityDiv, productPriceSpan);
    });



}

// Load the JSON file and append the product to main
function loadData( type = "FOOD")
{   
    loadJSON('../Model/json/product.json', function(data) {
        data.forEach(item => {
            if(item.product_type == type)
            {
                appendProductToMain(item);
            }
        });
        
    });
}

// remove parent child in DOM
function removeDOM( id = "main")
{
    const parentElement = document.querySelector(id);

    while (parentElement.firstChild)
    {
        parentElement.removeChild(parentElement.firstChild);
    }
    
}



/* 
    This function is to add the menu to order panel

*/

function addProductToOrderPanel(productName, productQuantity, productPrice)
{
    if(parseInt(productQuantity.innerHTML) > 0)
    {
        addToOrderPanel(productName.innerHTML, productQuantity.innerHTML, productPrice.innerHTML);
    }
    
    productQuantity.innerHTML = 0;
}

function addToOrderPanel(name, quantity, price) {
    let wrapper = document.querySelector('#orderPanel');

    let container = document.createElement('div');
    container.classList.add('orderList');

    let productName = document.createElement('h4');
    productName.id = "product_name_list"
    productName.innerHTML = name;

    let productQuantity = document.createElement('div');
    productQuantity.id = "product_quantity_list";
    productQuantity.innerHTML = quantity;

    let sum = parseInt(quantity) * parseInt(price);

    let productPrice = document.createElement('div');
    productPrice.id = "product_price_list"
    productPrice.innerHTML = "P " + sum + ".00";


    let buttonContainer = document.createElement('div');
    buttonContainer.classList.add('order_action');
    let cancelActionButton = document.createElement('button');
    cancelActionButton.id = "order_action_button";
    cancelActionButton.innerHTML = "Cancel";

    container.appendChild(productName);
    container.appendChild(productQuantity);
    container.appendChild(productPrice);
    container.appendChild(buttonContainer);
    buttonContainer.appendChild(cancelActionButton);
    
    wrapper.appendChild(container);


    /* 
        Display the sum of all the product list order
    */
    displayTotal( sum );


/* 
    This function action of button order list remove the order
    if order is remove deduct the total price

*/
    cancelActionButton.addEventListener('click', e => {
        deductTotal( sum );
        container.remove();
    });

}




/* 
    This function action of button in menu increment and decrement quantity

*/

function buttonDecrement(value)
{
    let quantity = parseInt(value.innerHTML, 10); // Convert the innerHTML to an integer

    // Decrement the quantity and update the innerHTML
    if (quantity > 0) {
        value.innerHTML = quantity - 1;
    }
}

function buttonIncrement(value)
{
    let quantity = parseInt(value.innerHTML, 10); // Convert the innerHTML to an integer

    // Decrement the quantity and update the innerHTML
    if (quantity >= 0) value.innerHTML = quantity + 1;
    
}



/* 
    This function is to display Total Amount and deduct
*/

let displayTotalAmountElement = document.querySelector('#Total_amount');

function displayTotal( sum ) {

    
    let newValue = parseInt(displayTotalAmountElement.innerHTML, 10) + sum;
    displayTotalAmountElement.innerHTML = newValue;

}

function deductTotal( sum ) {

    let newValue = parseInt(displayTotalAmountElement.innerHTML, 10) - sum;
    displayTotalAmountElement.innerHTML = newValue;

}




/* 
    modal

*/

let checkOutButton = document.querySelector('#check_out_button');
let modal = document.querySelector('#modal');
let wrapper = document.querySelector('.container');

checkOutButton.addEventListener('click', e => {
    let totalAmout = parseInt(displayTotalAmountElement.innerHTML, 10);

    if(totalAmout > 0)
    {
        let modal = document.querySelector('#modal');
    
        modal.style.display = 'block';

        modal.style.position = 'fixed';
        modal.style.top = '0';
        modal.style.bottom = '0';
        modal.style.left = '0';
        modal.style.right = '0';

        modal.style.display = 'grid';
        modal.style.aligncontent = 'center';
        modal.style.justifycontent = 'center';

        
        wrapper.style.filter = 'blur(8px)';
        wrapper.style.webkitFilter = 'blur(8px)';

        document.querySelector('#modal_display_total').value = displayTotalAmountElement.innerHTML;
        document.querySelector('#modal_receipt').value = JSON.stringify(getAllTheOrderList());
        

        if(displayTotalAmountElement.innerHTML == "0")
        {
            displayTotalAmountElement.innerHTML = 0;
            removeDOM("#orderPanel");
        }
    }
    
});


document.querySelector('#modal_cancel').addEventListener('click', e => {

    modal.style.display = 'none';


    wrapper.style.filter = 'none';
    wrapper.style.webkitFilter = 'none';
});



function getAllTheOrderList() {
    let receipt = [];
    let product_names = document.querySelectorAll('#product_name_list');
    let product_quantities = document.querySelectorAll('#product_quantity_list');
    let product_total_prices = document.querySelectorAll('#product_price_list');

    console.log(product_names.length);

    // Assuming product_names, product_quantities, and product_total_prices have the same length
    product_names.forEach((element, index) => {
        receipt.push({
            "product_name": product_names[index].innerHTML,
            "product_quantity": product_quantities[index].innerHTML,
            "product_total_price": product_total_prices[index].innerHTML
        });
    });
        
    return receipt;
}
