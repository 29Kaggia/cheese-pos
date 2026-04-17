<div style="padding: 24px 0; font-family: 'DM Sans', sans-serif;">

  <p style="font-size: 11px; font-weight: 600; letter-spacing: .07em; text-transform: uppercase; color: #9ca3af; margin: 0 0 14px;">
    Overview
  </p>

  <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px;">

    <div style="background: #f9fafb; border-radius: 8px; padding: 16px 20px;">
      <p style="font-size: 11px; font-weight: 500; letter-spacing: .07em; text-transform: uppercase; color: #9ca3af; margin: 0 0 8px;">
        <span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:#27500A;margin-right:5px;vertical-align:middle"></span>
        Total sales
      </p>
      <p style="font-family: monospace; font-size: 24px; font-weight: 600; color: #111827; margin: 0;">
        Ksh <?= number_format($totalSales) ?>
      </p>
      <p style="font-size: 12px; color: #9ca3af; margin: 4px 0 0;">All time</p>
    </div>

    <div style="background: #f9fafb; border-radius: 8px; padding: 16px 20px;">
      <p style="font-size: 11px; font-weight: 500; letter-spacing: .07em; text-transform: uppercase; color: #9ca3af; margin: 0 0 8px;">
        <span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:#185FA5;margin-right:5px;vertical-align:middle"></span>
        Today's sales
      </p>
      <p style="font-family: monospace; font-size: 24px; font-weight: 600; color: #111827; margin: 0;">
        Ksh <?= number_format($todaySales) ?>
      </p>
      <p style="font-size: 12px; color: #9ca3af; margin: 4px 0 0;"><?= date('M j, Y') ?></p>
    </div>

  </div>
</div>