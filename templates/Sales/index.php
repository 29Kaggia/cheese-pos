<style>
  @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=JetBrains+Mono:wght@400;600&display=swap');

  .pos-wrap { font-family: 'DM Sans', sans-serif; display: grid; grid-template-columns: 1fr 360px; height: calc(100vh - 80px); border-radius: 14px; overflow: hidden; border: 0.5px solid #e5e7eb; }

  /* ── LEFT ── */
  .pos-left { background: #fafaf8; display: flex; flex-direction: column; overflow: hidden; }
  .pos-left-header { padding: 18px 20px 14px; border-bottom: 0.5px solid #e5e7eb; background: #fff; display: flex; align-items: center; justify-content: space-between; }
  .pos-left-body { flex: 1; overflow-y: auto; padding: 16px; }

  .section-label { font-size: 10px; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; color: #9ca3af; margin: 0; }

  .product-grid { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 8px; }

  .product-btn { background: #fff; border: 0.5px solid #e5e7eb; border-radius: 10px; padding: 14px 12px; cursor: pointer; text-align: left; transition: border-color .15s, box-shadow .15s; display: flex; flex-direction: column; gap: 5px; }
  .product-btn:hover { border-color: #185FA5; box-shadow: 0 0 0 3px #E6F1FB; }
  .product-btn:active { transform: scale(.97); }
  .p-name  { font-size: 13px; font-weight: 500; color: #111827; line-height: 1.3; }
  .p-price { font-family: 'JetBrains Mono', monospace; font-size: 13px; font-weight: 600; color: #185FA5; }
  .p-stock { font-size: 10px; color: #9ca3af; }

  /* stock badge on card */
  .p-stock-badge { display: inline-block; font-size: 9px; font-family: 'JetBrains Mono', monospace; font-weight: 600; border-radius: 3px; padding: 1px 5px; }
  .p-stock-badge.ok  { background: #EAF3DE; color: #27500A; }
  .p-stock-badge.low { background: #FAEEDA; color: #633806; }
  .p-stock-badge.out { background: #FCEBEB; color: #A32D2D; }

  /* ── RIGHT ── */
  .pos-right { background: #fff; border-left: 0.5px solid #e5e7eb; display: flex; flex-direction: column; }

  .cart-header { padding: 18px 20px 14px; border-bottom: 0.5px solid #e5e7eb; display: flex; align-items: center; justify-content: space-between; }
  .cart-title  { font-size: 13px; font-weight: 600; color: #111827; display: flex; align-items: center; gap: 8px; }
  .item-badge  { display: inline-flex; align-items: center; justify-content: center; background: #E6F1FB; color: #185FA5; border-radius: 99px; font-size: 10px; font-weight: 600; width: 20px; height: 20px; font-family: 'JetBrains Mono', monospace; }
  .cart-clear  { font-size: 11px; color: #9ca3af; background: none; border: none; cursor: pointer; padding: 0; }
  .cart-clear:hover { color: #A32D2D; }

  .cart-body  { flex: 1; overflow-y: auto; }
  .cart-empty { padding: 48px 20px; text-align: center; color: #d1d5db; font-size: 13px; }
  .cart-empty-icon { font-size: 28px; display: block; margin-bottom: 8px; color: #e5e7eb; }

  .cart-row { display: grid; grid-template-columns: 1fr auto auto auto; align-items: center; gap: 10px; padding: 11px 20px; border-bottom: 0.5px solid #f3f4f6; transition: background .1s; }
  .cart-row:hover { background: #fafaf8; }
  .cr-name   { font-size: 13px; font-weight: 500; color: #111827; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .cr-qty    { font-size: 11px; font-family: 'JetBrains Mono', monospace; font-weight: 600; color: #6b7280; background: #f3f4f6; border-radius: 4px; padding: 3px 8px; }
  .cr-price  { font-family: 'JetBrains Mono', monospace; font-size: 12px; font-weight: 600; color: #111827; min-width: 76px; text-align: right; }
  .cr-remove { background: none; border: none; color: #d1d5db; cursor: pointer; padding: 3px 5px; border-radius: 4px; font-size: 12px; line-height: 1; transition: color .1s, background .1s; }
  .cr-remove:hover { color: #A32D2D; background: #FCEBEB; }

  .cart-footer { padding: 16px 20px; border-top: 0.5px solid #e5e7eb; background: #fff; }

  .subtotal-row { display: flex; justify-content: space-between; align-items: center; padding: 6px 0; border-bottom: 0.5px solid #f3f4f6; margin-bottom: 12px; }
  .subtotal-label { font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: .07em; font-weight: 500; }
  .subtotal-val   { font-family: 'JetBrains Mono', monospace; font-size: 11px; color: #6b7280; }

  .total-row   { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 14px; }
  .total-label { font-size: 11px; font-weight: 600; color: #111827; text-transform: uppercase; letter-spacing: .08em; }
  .total-amount { font-family: 'JetBrains Mono', monospace; font-size: 24px; font-weight: 600; color: #111827; }

  .checkout-btn { width: 100%; padding: 13px; background: #111827; color: #fff; border: none; border-radius: 10px; font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 600; cursor: pointer; letter-spacing: .02em; transition: background .15s; }
  .checkout-btn:hover { background: #1f2937; }
  .checkout-btn:active { transform: scale(.98); }
  .checkout-btn:disabled { background: #e5e7eb; color: #9ca3af; cursor: not-allowed; }
</style>

<div class="pos-wrap">

  <!-- ── LEFT: PRODUCTS ──────────────────────────────────── -->
  <div class="pos-left">
    <div class="pos-left-header">
      <p class="section-label">Products</p>
      <span style="font-size:11px; color:#9ca3af;"><?= count($products) ?> items</span>
    </div>

    <div class="pos-left-body">
      <div class="product-grid">
        <?php foreach ($products as $product):
          $s = $product->stock;
          $badgeClass = $s <= 0 ? 'out' : ($s <= 5 ? 'low' : 'ok');
          $badgeText  = $s <= 0 ? 'Out of stock' : ($s <= 5 ? "$s left" : "$s in stock");
          $disabled   = $s <= 0 ? 'disabled' : '';
        ?>
          <button type="button"
                  onclick="addToCart(<?= $product->id ?>, '<?= h($product->name) ?>', <?= $product->price ?>)"
                  class="product-btn"
                  <?= $disabled ?>
                  style="<?= $s <= 0 ? 'opacity:.45; cursor:not-allowed;' : '' ?>">
            <span class="p-name"><?= h($product->name) ?></span>
            <span class="p-price">Ksh <?= number_format($product->price) ?></span>
            <span class="p-stock-badge <?= $badgeClass ?>"><?= $badgeText ?></span>
          </button>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- ── RIGHT: CART ─────────────────────────────────────── -->
  <div class="pos-right">

    <div class="cart-header">
      <span class="cart-title">
        Cart
        <span class="item-badge" id="itemCount">0</span>
      </span>
      <button class="cart-clear" onclick="clearCart()">Clear all</button>
    </div>

    <?= $this->Form->create(null, ['style' => 'display:contents']) ?>

      <div class="cart-body" id="cartBody">
        <div class="cart-empty">
          <span class="cart-empty-icon">□</span>
          No items added yet
        </div>
      </div>

      <div class="cart-footer">
        <div class="subtotal-row">
          <span class="subtotal-label">Items</span>
          <span class="subtotal-val" id="itemTotal">0</span>
        </div>
        <div class="total-row">
          <span class="total-label">Total</span>
          <span class="total-amount">Ksh <span id="total">0</span></span>
        </div>
        <input type="hidden" name="total" id="totalInput">
        <input type="hidden" name="items" id="itemsInput">
        <button class="checkout-btn" id="checkoutBtn" disabled>Checkout →</button>
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

function clearCart() {
  if (cart.length === 0) return;
  cart = [];
  renderCart();
}

function renderCart() {
  const body = document.getElementById('cartBody');
  body.innerHTML = '';
  let total = 0;
  let totalQty = 0;

  if (cart.length === 0) {
    body.innerHTML = '<div class="cart-empty"><span class="cart-empty-icon">□</span>No items added yet</div>';
  } else {
    cart.forEach(item => {
      const rowTotal = item.price * item.qty;
      total    += rowTotal;
      totalQty += item.qty;
      body.innerHTML += `
        <div class="cart-row">
          <span class="cr-name">${item.name}</span>
          <span class="cr-qty">×${item.qty}</span>
          <span class="cr-price">Ksh ${rowTotal.toLocaleString()}</span>
          <button type="button" class="cr-remove" onclick="removeItem(${item.id})">✕</button>
        </div>`;
    });
  }

  document.getElementById('total').textContent     = total.toLocaleString();
  document.getElementById('itemTotal').textContent = totalQty + ' item' + (totalQty !== 1 ? 's' : '');
  document.getElementById('totalInput').value      = total;
  document.getElementById('itemsInput').value      = JSON.stringify(cart);
  document.getElementById('itemCount').textContent = totalQty;
  document.getElementById('checkoutBtn').disabled  = cart.length === 0;
}
</script>