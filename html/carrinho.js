if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
  } else {
    ready()
  }
  
  let totalAmount = 0;
  let cartItems = []; // Array para armazenar os itens do carrinho
  
  function ready() {
    // Botão remover produto
    const removeCartProductButtons = document.getElementsByClassName("remove-product-button")
    for (var i = 0; i < removeCartProductButtons.length; i++) {
        removeCartProductButtons[i].addEventListener("click", removeProduct)
    }
  
    // Mudança valor dos inputs
    const quantityInputs = document.getElementsByClassName("product-qtd-input")
    for (var i = 0; i < quantityInputs.length; i++) {
        quantityInputs[i].addEventListener("change", checkIfInputIsNull)
    }
  
    // Botão add produto ao carrinho
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('button-hover-background')) {
            event.preventDefault(); 
            addProductToCart(event);
        }
    });
  
    // Botão comprar
    const purchaseButton = document.getElementsByClassName("purchase-button")[0]
    purchaseButton.addEventListener("click", makePurchase)
  }
  
  function removeProduct(event) {
    const cartRow = event.target.parentElement.parentElement;
    const productId = cartRow.dataset.productId; 
    const productPrice = parseFloat(cartRow.querySelector('.cart-product-price').innerText.replace("R$:", "").replace(",", "."));
  
    // Remover o item do array cartItems
    cartItems = cartItems.filter(item => item.productId !== productId);
  
    cartRow.remove();
    updateTotal(-productPrice); 
    updateCartItemCount();
  }
  
  function checkIfInputIsNull(event) {
    const cartRow = event.target.parentElement.parentElement;
    const productId = cartRow.dataset.productId;
    const newQuantity = parseInt(event.target.value);
  
    updateProductQuantity(productId, newQuantity); 
  }
  
  function addProductToCart(event) {
    const button = event.target
    const productCard = button.closest('.card'); 
  
    const productId = button.dataset.id; 
    const productImage = productCard.querySelector('.product-image').src
    const productName = productCard.querySelector('.product-title').innerText
    const productPriceText = productCard.querySelector('.product-price').innerText; 
    const productPrice = parseFloat(productPriceText.replace("R$:", "").replace(",", "."));
  
    // Verificar se o produto já está no carrinho
    const existingCartItemIndex = cartItems.findIndex(item => item.productId === productId);
  
    if (existingCartItemIndex !== -1) {
        cartItems[existingCartItemIndex].quantity++;
    } else {
        // Criar um novo objeto para armazenar os detalhes do produto
        const newItem = {
            productId: productId,
            productImage: productImage,
            productName: productName,
            productPrice: productPrice,
            productPriceText: productPriceText,
            quantity: 1
        };
        cartItems.push(newItem);
    }
  
    updateCartDisplay();
    updateTotal();
    updateCartItemCount();
  }
  
  function makePurchase() {
      if (cartItems.length === 0) {
          alert("Seu carrinho está vazio!");
      } else {
          // Calcula a quantidade total de itens
          let totalQuantity = 0;
          cartItems.forEach(item => {
              totalQuantity += item.quantity;
          });
  
       
          localStorage.setItem('cartItems', JSON.stringify(cartItems));
          localStorage.setItem('totalAmount', totalAmount); 
          localStorage.setItem('totalQuantity', totalQuantity);
  
  
        
          window.location.href = "pagina_de_pagamento_e_envio.html"; 
      }
  }
  
  function updateCartDisplay() {
    const tableBody = document.querySelector(".cart-table tbody");
    tableBody.innerHTML = ''; 
  
    cartItems.forEach(item => {
        const newCartProduct = document.createElement("tr");
        newCartProduct.classList.add("cart-product");
        newCartProduct.dataset.productId = item.productId;
  
        newCartProduct.innerHTML = `
            <td class="product-identification">
                <img src="${item.productImage}" alt="${item.productName}" class="cart-product-image">
                <strong class="cart-product-title">${item.productName}</strong>
            </td>
            <td>
                <span class="cart-product-price">${item.productPriceText}</span>
            </td>
            <td>
                <input type="number" value="${item.quantity}" min="1" class="product-qtd-input">
                <button type="button" class="remove-product-button">Remover</button>
            </td>
        `;
  
        tableBody.append(newCartProduct);
  
        newCartProduct.getElementsByClassName("remove-product-button")[0].addEventListener("click", removeProduct);
        newCartProduct.getElementsByClassName("product-qtd-input")[0].addEventListener("change", checkIfInputIsNull);
    });
  }
  
  
  function updateTotal() {
    totalAmount = 0;
    cartItems.forEach(item => {
        totalAmount += item.productPrice * item.quantity;
    });
    document.querySelector(".cart-total-container span").innerText = "R$" + totalAmount.toFixed(2).replace(".", ",");
  }
  
  const notificationCartSpan = document.querySelector('.NotificationCart');
  
  
  function updateCartItemCount() {
   const quantityInputs = document.querySelectorAll('.cart-product .product-qtd-input'); 
   let totalQuantity = 0;
  
  quantityInputs.forEach(input => {
  totalQuantity += parseInt(input.value);
  });
  
  notificationCartSpan.textContent = totalQuantity; 
  }
  
  function consutaEndereco(){
    let cep = document.querySelector('#cep').value;
  
    if(cep.length !==8){
        alert('Cep inválido');
        return;
    }
  
    fetch(url).then(function(response){
        response.json().then(function(data){
            mostrarEndereco(data);
            console.log(data);
        })
    });
  }
  
  function mostrarEndereco(dados){
    let resultado = document.querySelector('#resultado');
    if(dados.erro){
        resultado.innerHTML = "Não foi possível localizar o endereço";
    } else{
        resultado.innerHTML = `
                                <form action="" method="post">
                                <input type="hidden" id="logradouro" name="logradouro" >Endereço: ${dados.logradouro}</input>
                                <input type="hidden" id="bairro" name="bairro" >Bairro: ${dados.bairro}</input>
                                <input type="hidden" id="localidade" name="localidade" >Cidade: ${dados.localidade}</input>
                                <input type="hidden" id="uf" name="uf" >Estado: ${dados.uf}</input>
                                <input type="number"  placeholder="Digite o numero de sua residencia"></input>
                                <button type="submit">Confirmar endereço.</button>
                                </form>
                            `;
    }
  }