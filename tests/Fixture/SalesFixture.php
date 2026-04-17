<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SalesFixture
 */
class SalesFixture extends TestFixture
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
                'total' => 1.5,
                'created' => '2026-04-17 11:09:42',
                'modified' => '2026-04-17 11:09:42',
            ],
        ];
        parent::init();
    }
}
