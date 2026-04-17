<div style="padding: 24px 0; font-family: 'DM Sans', sans-serif;">

  <p style="font-size: 11px; font-weight: 600; letter-spacing: .07em; text-transform: uppercase; color: #9ca3af; margin: 0 0 14px;">
    Admin
  </p>

  <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px;">

    <!-- Total Products -->
    <div style="background: #f9fafb; border-radius: 8px; padding: 16px 20px;">
      <p style="font-size: 11px; font-weight: 500; letter-spacing: .07em; text-transform: uppercase; color: #9ca3af; margin: 0 0 8px;">
        <span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:#185FA5;margin-right:5px;vertical-align:middle"></span>
        Total products
      </p>
      <p style="font-family: monospace; font-size: 28px; font-weight: 600; color: #111827; margin: 0; line-height: 1;">
        <?= number_format($totalProducts) ?>
      </p>
      <p style="font-size: 12px; color: #9ca3af; margin: 6px 0 0;">Active SKUs</p>
    </div>

    <!-- Low Stock -->
    <div style="background: #f9fafb; border-radius: 8px; padding: 16px 20px;">
      <p style="font-size: 11px; font-weight: 500; letter-spacing: .07em; text-transform: uppercase; color: #9ca3af; margin: 0 0 12px;">
        <span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:#A32D2D;margin-right:5px;vertical-align:middle"></span>
        Low stock
      </p>

      <?php if (empty($lowStock)): ?>
        <p style="font-size: 12px; color: #9ca3af; margin: 0;">All items stocked</p>
      <?php else: ?>
        <?php foreach ($lowStock as $item): ?>
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 5px 0; border-bottom: 0.5px solid #f0f0ec;">
            <span style="font-size: 12px; color: #374151;"><?= h($item->name) ?></span>
            <span style="font-size: 11px; font-family: monospace; background: #FCEBEB; color: #A32D2D; border-radius: 4px; padding: 2px 7px; font-weight: 600;">
              <?= $item->stock ?> left
            </span>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

    </div>

  </div>
</div>