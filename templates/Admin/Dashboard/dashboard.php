<style>
  @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=JetBrains+Mono:wght@400;600&display=swap');

  .dash { font-family: 'DM Sans', sans-serif; max-width: 1080px; padding: 32px 0; }

  .dash-section-label { font-size: 10px; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; color: #9ca3af; margin: 0 0 20px; }

  .dash-grid-2 { display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 12px; }
  .dash-grid-3 { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 12px; }
  .dash-grid-4 { display: grid; grid-template-columns: repeat(4, minmax(0,1fr)); gap: 12px; }

  .card { background: #fff; border: 0.5px solid #e5e7eb; border-radius: 12px; padding: 20px 22px; }
  .card-flush { background: #fff; border: 0.5px solid #e5e7eb; border-radius: 12px; overflow: hidden; }

  .metric-card { background: #fff; border: 0.5px solid #e5e7eb; border-radius: 12px; padding: 20px 22px; position: relative; overflow: hidden; }
  .metric-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; border-radius: 12px 12px 0 0; }
  .metric-card.green::before  { background: #3B6D11; }
  .metric-card.blue::before   { background: #185FA5; }
  .metric-card.amber::before  { background: #854F0B; }
  .metric-card.purple::before { background: #534AB7; }

  .metric-label { font-size: 11px; font-weight: 500; letter-spacing: .07em; text-transform: uppercase; color: #9ca3af; margin: 0 0 10px; }
  .metric-value { font-family: 'JetBrains Mono', monospace; font-size: 26px; font-weight: 600; color: #111827; margin: 0; line-height: 1; }
  .metric-sub   { font-size: 11px; color: #9ca3af; margin: 7px 0 0; }

  .card-title { font-size: 11px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: #6b7280; margin: 0 0 16px; display: flex; align-items: center; gap: 7px; }
  .card-title-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }

  .pill { font-size: 10px; font-family: 'JetBrains Mono', monospace; font-weight: 600; border-radius: 4px; padding: 2px 8px; }

  .bar-track { background: #f0f0ec; border-radius: 99px; overflow: hidden; }
  .bar-fill  { border-radius: 99px; }

  .divrow { border-bottom: 0.5px solid #f3f4f6; }
  .divrow:last-child { border-bottom: none; }

  .action-btn { font-size: 11px; font-weight: 600; text-decoration: none; border-radius: 7px; padding: 6px 14px; border: 0.5px solid; display: inline-block; transition: opacity .15s; }
  .action-btn:hover { opacity: .8; }

  .tbl { width: 100%; border-collapse: collapse; font-size: 12px; }
  .tbl th { text-align: left; padding: 0 12px 10px; font-size: 10px; font-weight: 600; letter-spacing: .07em; text-transform: uppercase; color: #9ca3af; }
  .tbl th:last-child { text-align: right; }
  .tbl td { padding: 9px 12px; border-top: 0.5px solid #f3f4f6; color: #374151; }
  .tbl td:last-child { text-align: right; }
  .tbl tbody tr:hover td { background: #fafaf8; }

  .flush-header { padding: 16px 22px; border-bottom: 0.5px solid #e5e7eb; }
</style>

<div class="dash">

  <p class="dash-section-label">Admin dashboard · <?= date('l, M j Y') ?></p>

  <!-- ── ROW 1: METRIC CARDS ───────────────────────────────── -->
  <div class="dash-grid-2" style="margin-bottom:12px;">

    <div class="metric-card green">
      <p class="metric-label">Total revenue</p>
      <p class="metric-value">Ksh <?= number_format($totalRevenue) ?></p>
      <p class="metric-sub">All time · cumulative sales</p>
    </div>

    <div class="metric-card blue">
      <p class="metric-label">Total products</p>
      <p class="metric-value"><?= number_format($totalProducts) ?></p>
      <p class="metric-sub">Active SKUs in catalogue</p>
    </div>

  </div>

  <!-- ── ROW 2: BEST SELLERS + LOW STOCK ──────────────────── -->
  <div class="dash-grid-2" style="margin-bottom:12px;">

    <!-- Best Sellers -->
    <div class="card">
      <p class="card-title">
        <span class="card-title-dot" style="background:#3B6D11;"></span>
        Top products
      </p>

      <?php if (!empty($bestSellers)):
        $maxSold = max(array_map(fn($i) => (int)$i->total_sold, $bestSellers)) ?: 1;
        foreach ($bestSellers as $idx => $item):
          $pct = round(((int)$item->total_sold / $maxSold) * 100);
      ?>
        <div class="divrow" style="padding: 9px 0;">
          <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:7px;">
            <div style="display:flex; align-items:center; gap:8px;">
              <span style="font-size:10px; font-family:'JetBrains Mono',monospace; color:#9ca3af; width:14px;"><?= $idx + 1 ?></span>
              <span style="font-size:13px; font-weight:500; color:#111827;"><?= h($item->product_name ?? 'Unknown') ?></span>
            </div>
            <span class="pill" style="background:#EAF3DE; color:#27500A;"><?= (int)$item->total_sold ?> sold</span>
          </div>
          <div style="padding-left:22px;">
            <div class="bar-track" style="height:5px;">
              <div class="bar-fill" style="background:#3B6D11; height:5px; width:<?= $pct ?>%;"></div>
            </div>
          </div>
        </div>
      <?php endforeach; else: ?>
        <p style="font-size:12px; color:#9ca3af; margin:0;">No sales recorded yet</p>
      <?php endif; ?>
    </div>

    <!-- Low Stock -->
    <div class="card">
      <p class="card-title">
        <span class="card-title-dot" style="background:#A32D2D;"></span>
        Low stock alerts
      </p>

      <?php if (empty($lowStock)): ?>
        <div style="display:flex; align-items:center; gap:8px; padding:10px 0;">
          <span style="font-size:18px;">✓</span>
          <p style="font-size:12px; color:#3B6D11; margin:0; font-weight:500;">All products well stocked</p>
        </div>
      <?php else: ?>
        <?php foreach ($lowStock as $item): ?>
          <div class="divrow" style="display:flex; justify-content:space-between; align-items:center; padding:8px 0;">
            <span style="font-size:13px; color:#374151;"><?= h($item->name) ?></span>
            <?php
              $sc = $item->stock;
              $bg = $sc <= 0 ? '#FCEBEB' : '#FAEEDA';
              $tc = $sc <= 0 ? '#A32D2D' : '#633806';
              $label = $sc <= 0 ? 'Out of stock' : "$sc left";
            ?>
            <span class="pill" style="background:<?= $bg ?>; color:<?= $tc ?>;"><?= $label ?></span>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

      <a href="/admin/products" class="action-btn" style="color:#185FA5; background:#E6F1FB; border-color:#B5D4F4; margin-top:16px; display:block; text-align:center;">
        Manage stock →
      </a>
    </div>

  </div>

  <!-- ── ROW 3: STOCK LEVELS ───────────────────────────────── -->
  <div class="card-flush" style="margin-bottom:12px;">
    <div class="flush-header">
      <p class="card-title" style="margin:0;">
        <span class="card-title-dot" style="background:#854F0B;"></span>
        Stock levels
      </p>
    </div>

    <div style="padding:8px 22px 16px; display:grid; grid-template-columns:repeat(2, minmax(0,1fr)); gap:0 40px;">
      <?php foreach ($stockLevels as $product):
        $max   = $product->max_stock ?? 100;
        $pct   = $max > 0 ? round(($product->stock / $max) * 100) : 0;
        $color = $pct < 30 ? '#A32D2D' : ($pct < 60 ? '#854F0B' : '#3B6D11');
        $bg    = $pct < 30 ? '#FCEBEB' : ($pct < 60 ? '#FAEEDA' : '#EAF3DE');
        $tc    = $pct < 30 ? '#A32D2D' : ($pct < 60 ? '#633806' : '#27500A');
      ?>
        <div class="divrow" style="display:flex; align-items:center; gap:12px; padding:9px 0;">
          <span style="font-size:12px; color:#374151; width:110px; flex-shrink:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
            <?= h($product->name) ?>
          </span>
          <div class="bar-track" style="flex:1; height:6px;">
            <div class="bar-fill" style="background:<?= $color ?>; height:6px; width:<?= $pct ?>%; min-width:<?= $product->stock > 0 ? '4' : '0' ?>px;"></div>
          </div>
          <span class="pill" style="background:<?= $bg ?>; color:<?= $tc ?>; min-width:40px; text-align:center;">
            <?= $product->stock ?>
          </span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- ── ROW 4: RECENT SALES ───────────────────────────────── -->
  <div class="card-flush" style="margin-bottom:12px;">
    <div class="flush-header">
      <p class="card-title" style="margin:0;">
        <span class="card-title-dot" style="background:#534AB7;"></span>
        Recent sales
      </p>
    </div>

    <?php if (empty($recentSales)): ?>
      <p style="font-size:12px; color:#9ca3af; padding:20px 22px; margin:0;">No sales yet</p>
    <?php else: ?>
      <table class="tbl">
        <thead>
          <tr>
            <th style="width:80px;">Receipt</th>
            <th>Date &amp; time</th>
            <th style="text-align:right;">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($recentSales as $sale): ?>
            <tr>
              <td>
                <span style="font-family:'JetBrains Mono',monospace; font-size:11px; color:#9ca3af;">#<?= $sale->id ?></span>
              </td>
              <td style="color:#374151;"><?= $sale->created->format('M j, Y · H:i') ?></td>
              <td>
                <span style="font-family:'JetBrains Mono',monospace; font-weight:600; color:#111827;">
                  Ksh <?= number_format($sale->total) ?>
                </span>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>

  <!-- ── QUICK ACTIONS ────────────────────────────────────── -->
  <div class="card">
    <p class="card-title" style="margin-bottom:12px;">
      <span class="card-title-dot" style="background:#9ca3af;"></span>
      Quick actions
    </p>
    <div style="display:flex; gap:8px; flex-wrap:wrap;">
      <a href="/admin/products/add" class="action-btn" style="color:#185FA5; background:#E6F1FB; border-color:#B5D4F4;">+ Add product</a>
      <a href="/admin/products"     class="action-btn" style="color:#633806; background:#FAEEDA; border-color:#FAC775;">Low stock</a>
      <a href="/admin/sales"        class="action-btn" style="color:#27500A; background:#EAF3DE; border-color:#C0DD97;">Sales history</a>
      <a href="/admin/sales/last"   class="action-btn" style="color:#3C3489; background:#EEEDFE; border-color:#CECBF6;">Print last receipt</a>
    </div>
  </div>

</div>