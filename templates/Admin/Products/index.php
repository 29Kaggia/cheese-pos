<div style="padding: 24px 0; font-family: 'DM Sans', sans-serif;">

  <!-- Header row -->
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <p style="font-size: 11px; font-weight: 600; letter-spacing: .07em; text-transform: uppercase; color: #9ca3af; margin: 0;">
      Products
    </p>
    <a href="/admin/products/add"
       style="font-size: 12px; font-weight: 600; color: #185FA5; text-decoration: none; background: #E6F1FB; border-radius: 6px; padding: 5px 12px;">
      + Add product
    </a>
  </div>

  <!-- Table -->
  <div style="border: 0.5px solid #e5e7eb; border-radius: 10px; overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse; font-size: 13px;">

      <thead>
        <tr style="background: #f9fafb; border-bottom: 0.5px solid #e5e7eb;">
          <th style="padding: 10px 16px; text-align: left; font-size: 10px; font-weight: 600; letter-spacing: .07em; text-transform: uppercase; color: #9ca3af; width: 48px;">ID</th>
          <th style="padding: 10px 16px; text-align: left; font-size: 10px; font-weight: 600; letter-spacing: .07em; text-transform: uppercase; color: #9ca3af;">Name</th>
          <th style="padding: 10px 16px; text-align: right; font-size: 10px; font-weight: 600; letter-spacing: .07em; text-transform: uppercase; color: #9ca3af;">Price</th>
          <th style="padding: 10px 16px; text-align: center; font-size: 10px; font-weight: 600; letter-spacing: .07em; text-transform: uppercase; color: #9ca3af;">Stock</th>
          <th style="padding: 10px 16px; text-align: right; font-size: 10px; font-weight: 600; letter-spacing: .07em; text-transform: uppercase; color: #9ca3af;">Actions</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($products as $i => $product): ?>
        <tr style="border-bottom: 0.5px solid #f0f0ec; background: <?= $i % 2 === 0 ? '#fff' : '#fafaf8' ?>;">

          <td style="padding: 11px 16px; font-family: monospace; font-size: 11px; color: #9ca3af;">
            #<?= $product->id ?>
          </td>

          <td style="padding: 11px 16px; font-weight: 500; color: #111827;">
            <?= h($product->name) ?>
          </td>

          <td style="padding: 11px 16px; text-align: right; font-family: monospace; font-size: 13px; color: #185FA5; font-weight: 600;">
            Ksh <?= number_format($product->price) ?>
          </td>

          <td style="padding: 11px 16px; text-align: center;">
            <?php if ($product->stock <= 0): ?>
              <span style="font-size: 10px; font-weight: 600; font-family: monospace; background: #FCEBEB; color: #A32D2D; border-radius: 4px; padding: 2px 8px;">Out of stock</span>
            <?php elseif ($product->stock <= 5): ?>
              <span style="font-size: 10px; font-weight: 600; font-family: monospace; background: #FAEEDA; color: #633806; border-radius: 4px; padding: 2px 8px;"><?= $product->stock ?> left</span>
            <?php else: ?>
              <span style="font-size: 10px; font-weight: 600; font-family: monospace; background: #EAF3DE; color: #27500A; border-radius: 4px; padding: 2px 8px;"><?= $product->stock ?> in stock</span>
            <?php endif; ?>
          </td>

          <td style="padding: 11px 16px; text-align: right;">
            <div style="display: inline-flex; gap: 6px;">
              <a href="/admin/products/edit/<?= $product->id ?>"
                 style="font-size: 11px; font-weight: 600; color: #374151; background: #fff; border: 0.5px solid #d1d5db; border-radius: 5px; padding: 4px 10px; text-decoration: none;">
                Edit
              </a>
              <a href="/admin/products/delete/<?= $product->id ?>"
                 onclick="return confirm('Delete <?= h($product->name) ?>?')"
                 style="font-size: 11px; font-weight: 600; color: #A32D2D; background: #FCEBEB; border: 0.5px solid #F7C1C1; border-radius: 5px; padding: 4px 10px; text-decoration: none;">
                Delete
              </a>
            </div>
          </td>

        </tr>
        <?php endforeach; ?>
      </tbody>

    </table>

    <!-- Empty state -->
    <?php if (empty($products)): ?>
      <div style="text-align: center; padding: 48px 20px; background: #fff;">
        <p style="font-size: 13px; color: #9ca3af; margin: 0 0 12px;">No products yet</p>
        <a href="/admin/products/add"
           style="font-size: 12px; font-weight: 600; color: #185FA5; text-decoration: none; background: #E6F1FB; border-radius: 6px; padding: 6px 14px;">
          + Add your first product
        </a>
      </div>
    <?php endif; ?>

  </div>

</div>