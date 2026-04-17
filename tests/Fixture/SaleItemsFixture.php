<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SaleItemsFixture
 */
class SaleItemsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'sale_id' => 1,
                'product_id' => 1,
                'quantity' => 1,
                'price' => 1.5,
                'created' => '2026-04-17 11:09:42',
                'modified' => '2026-04-17 11:09:42',
            ],
        ];
        parent::init();
    }
}
