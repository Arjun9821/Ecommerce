// app.js - small helpers
document.addEventListener('DOMContentLoaded', function(){
  // update nav cart count from localStorage (example)
  const el = document.getElementById('nav-cart-count');
  if(el){
    const count = localStorage.getItem('cart_count') || 0;
    el.innerText = count;
  }
});
