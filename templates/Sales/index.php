<style>
  .pos-wrap { font-family: 'DM Sans', sans-serif; display: grid; grid-template-columns: 1fr 380px; gap: 0; border-radius: 12px; overflow: hidden; border: 0.5px solid #d1d5db; }
  .pos-left { background: #fff; padding: 20px; }
  .pos-right { background: #f9fafb; border-left: 0.5px solid #e5e7eb; display: flex; flex-direction: column; }
  .section-label { font-size: 11px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: #9ca3af; margin: 0 0 12px; }
  .product-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 8px; }
  .product-btn { background: #f9fafb; border: 0.5px solid #e5e7eb; border-radius: 8px; padding: 12px 10px; cursor: pointer; text-align: left; transition: background .15s, border-color .15s; }
  .product-btn:hover { background: #f3f4f6; border-color: #d1d5db; }
  .product-btn .p-name { font-size: 13px; font-weight: 500; color: #111827; line-height: 1.3; display: block; }
  .product-btn .p-price { font-family: 'JetBrains Mono', monospace; font-size: 13px; font-weight: 600; color: #2563eb; display: block; }
  .product-btn .p-stock { font-size: 11px; color: #9ca3af; display: block; }
  .cart-header { padding: 16px 20px 12px; border-bottom: 0.5px solid #e5e7eb; }
  .cart-body { flex: 1; overflow-y: auto; padding: 8px 0; }
  .cart-empty { padding: 40px 20px; text-align: center; color: #9ca3af; font-size: 13px; }
  .cart-row { display: grid; grid-template-columns: 1fr auto auto auto; align-items: center; gap: 10px; padding: 10px 20px; border-bottom: 0.5px solid #e5e7eb; }
  .cr-name { font-size: 13px; font-weight: 500; }
  .cr-qty { font-size: 12px; color: #6b7280; background: #fff; border: 0.5px solid #e5e7eb; border-radius: 4px; padding: 2px 8px; font-family: monospace; }
  .cr-price { font-family: monospace; font-size: 13px; font-weight: 500; min-width: 70px; text-align: right; }
  .cr-remove { background: none; border: none; color: #9ca3af; cursor: pointer; padding: 2px 4px; border-radius: 4px; line-height: 1; }
  .cr-remove:hover { color: #dc2626; background: #fef2f2; }
  .cart-footer { padding: 16px 20px; border-top: 0.5px solid #d1d5db; }
  .total-row { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 14px; }
  .total-label { font-size: 12px; color: #6b7280; text-transform: uppercase; letter-spacing: .06em; font-weight: 500; }
  .total-amount { font-family: monospace; font-size: 22px; font-weight: 600; }
  .checkout-btn { width: 100%; padding: 11px; background: #f0fdf4; color: #15803d; border: 0.5px solid #86efac; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; }
  .checkout-btn:hover { background: #dcfce7; }
  .item-badge { display: inline-flex; align-items: center; justify-content: center; background: #dbeafe; color: #1d4ed8; border-radius: 99px; font-size: 11px; font-weight: 600; width: 18px; height: 18px; margin-left: 6px; vertical-align: middle; }
</style>

<div class="pos-wrap">

  <!-- LEFT: PRODUCTS -->
  <div class="pos-left">
    <p class="section-label">Products</p>
    <div class="product-grid">
      <?php foreach ($products as $product): ?>
        <button type="button"
                onclick="addToCart(<?= $product->id ?>, '<?= $product->name ?>', <?= $product->price ?>)"
                class="product-btn">
          <span class="p-name"><?= h($product->name) ?></span>
          <span class="p-price">Ksh <?= number_format($product->price) ?></span>
          <span class="p-stock">Stock: <?= $product->stock ?></span>
        </button>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- RIGHT: CART -->
  <div class="pos-right">
    <div class="cart-header">
      <p class="section-label" style="margin:0">
        Cart <span class="item-badge" id="itemCount">0</span>
      </p>
    </div>

    <?= $this->Form->create(null, ['style' => 'display:contents']) ?>
      <div class="cart-body" id="cartBody">
        <div class="cart-empty">No items yet</div>
      </div>

      <div class="cart-footer">
        <div class="total-row">
          <span class="total-label">Total</span>
          <span class="total-amount">Ksh <span id="total">0</span></span>
        </div>
        <input type="hidden" name="total" id="totalInput">
        <input type="hidden" name="items" id="itemsInput">
        <button class="checkout-btn">Checkout →</button>
      </div>
    </form>
  </div>

</div>

<script>
let cart = [];

function addToCart(id, name, price) {
  let item = cart.find(i => i.id === id);
  if (item) { item.qty++ } else { cart.push({ id, name, price, qty: 1 }) }
  renderCart();
}

function removeItem(id) {
  cart = cart.filter(i => i.id !== id);
  renderCart();
}

function renderCart() {
  const body = document.getElementById('cartBody');
  body.innerHTML = '';
  let total = 0;

  if (cart.length === 0) {
    body.innerHTML = '<div class="cart-empty">No items yet</div>';
  } else {
    cart.forEach(item => {
      const rowTotal = item.price * item.qty;
      total += rowTotal;
      body.innerHTML += `
        <div class="cart-row">
          <span class="cr-name">${item.name}</span>
          <span class="cr-qty">×${item.qty}</span>
          <span class="cr-price">Ksh ${rowTotal.toLocaleString()}</span>
          <button type="button" class="cr-remove" onclick="removeItem(${item.id})">✕</button>
        </div>`;
    });
  }

  document.getElementById('total').textContent = total.toLocaleString();
  document.getElementById('totalInput').value = total;
  document.getElementById('itemsInput').value = JSON.stringify(cart);
  document.getElementById('itemCount').textContent = cart.reduce((s, i) => s + i.qty, 0);
}
</script>