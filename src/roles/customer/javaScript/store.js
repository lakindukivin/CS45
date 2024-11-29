document.addEventListener('DOMContentLoaded', async () => {
  try {
    const response = await fetch(
      'http://localhost/cs45/app/controllers/ProductController.php?action=fetch'
    );

    if (!response.ok) throw new Error('Failed to fetch products');
    console.log(response);
    const products = await response.json();

    const container = document.getElementById('productsList');
    container.innerHTML = products
      .map((product) => {
        return `
          <div class="product-card">
          <img src="${product.product_img_url}" alt="${product.product_name}" style="width: 100px; height: 100px;" />
          <h3>${product.product_name}</h3>
         
            
          <button class="primary" onclick="openOptions(${product.product_id})">See Options</button>
        </div>`;
      })
      .join('');
  } catch (error) {
    console.error('Error:', error);
  }
  const cards = document.querySelectorAll('.product-card');

  const animateCards = () => {
    cards.forEach((card, index) => {
      setTimeout(() => {
        card.classList.add('visible');
      }, index * 300); // Delay each card's animation for a cascading effect
    });
  };

  // Call animateCards immediately when the page loads
  animateCards();
});

//Modal Control
function openOptionModal() {
  document.getElementById('option-modal').style.display = 'block';
}

function closeOptionModal() {
  document.getElementById('option-modal').style.display = 'none';
}

async function openOptions(product_id) {
  try {
    openOptionModal();
    const response = await fetch(
      `http://localhost/cs45/app/controllers/ProductController.php?action=view&product_id=${product_id}`
    );
    if (!response.ok) {
      throw new Error('Failed to fetch product details');
    }
    const product = await response.json();
    console.log(product);

    const container = document.getElementById('optionForm');
    container.innerHTML = `<div>
    <div class="product-image">
              <img src="${product.product_img_url}" alt="${product.product_name}" />
              <div class="product-details">
   <h2>${product.product_name}</h2>
              <h3>${product.product_price}</h3>
              <p>${product.product_description}</p>
   </div>
            </div>
   
   </div>`;
  } catch {}
}
