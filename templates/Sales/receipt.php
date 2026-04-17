<!DOCTYPE html>
<html>
<head>
    <title>Receipt #<?= $sale->id ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Courier New', monospace;
            background: #f5f5f0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 40px 16px;
        }

        .receipt {
            background: #fff;
            width: 300px;
            padding: 28px 24px;
            border: 0.5px solid #e0e0d8;
            border-radius: 4px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .shop-name {
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #1a1a1a;
        }

        .receipt-meta {
            font-size: 11px;
            color: #888;
            margin-top: 5px;
            letter-spacing: .04em;
        }

        .divider {
            border: none;
            border-top: 1px dashed #c8c8c0;
            margin: 16px 0;
        }

        .items { margin-bottom: 4px; }

        .item {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: 8px;
            padding: 5px 0;
            font-size: 12px;
            color: #222;
        }

        .item-name {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .item-qty {
            color: #999;
            font-size: 11px;
            flex-shrink: 0;
        }

        .item-price {
            flex-shrink: 0;
            text-align: right;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            padding: 10px 0 6px;
        }

        .total-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: #555;
        }

        .total-amount {
            font-size: 16px;
            font-weight: 700;
            color: #1a1a1a;
            letter-spacing: .02em;
        }

        .footer {
            text-align: center;
            margin-top: 18px;
        }

        .footer p {
            font-size: 11px;
            color: #aaa;
            letter-spacing: .05em;
        }

        .barcode {
            margin: 14px auto 0;
            display: flex;
            justify-content: center;
            gap: 1.5px;
            height: 28px;
            align-items: flex-end;
        }

        .barcode span {
            display: inline-block;
            background: #ccc;
            width: 2px;
        }

        @media print {
            body { background: #fff; padding: 0; }
            .receipt { border: none; border-radius: 0; width: 100%; }
        }
    </style>
</head>
<body onload="window.print()">

<div class="receipt">

    <div class="header">
        <div class="shop-name">Cheese POS</div>
        <div class="receipt-meta">
            Receipt #<?= $sale->id ?> &nbsp;&middot;&nbsp; <?= date('d M Y, H:i') ?>
        </div>
    </div>

    <hr class="divider">

    <div class="items">
        <?php foreach ($sale->sale_items as $item): ?>
            <div class="item">
                <span class="item-name"><?= h($item->product->name) ?></span>
                <span class="item-qty">x<?= $item->quantity ?></span>
                <span class="item-price">Ksh <?= number_format($item->price * $item->quantity) ?></span>
            </div>
        <?php endforeach; ?>
    </div>

    <hr class="divider">

    <div class="total-row">
        <span class="total-label">Total</span>
        <span class="total-amount">Ksh <?= number_format($sale->total) ?></span>
    </div>

    <hr class="divider">

    <div class="footer">
        <p>Thank you for your purchase</p>
        <div class="barcode" id="bc"></div>
    </div>

</div>

<script>
    const bc = document.getElementById('bc');
    const heights = [28,18,24,16,28,20,14,26,18,28,22,16,24,20,28,14,26,18,22,28,16,24,20,28,18,14,26,22,28,20];
    heights.forEach(h => {
        const b = document.createElement('span');
        b.style.height = h + 'px';
        bc.appendChild(b);
    });
</script>

</body>
</html>