<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Finance\tests\Models;

use Modules\Finance\Models\NullTaxCode;

/**
 * @internal
 */
final class NullTaxCodeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers \Modules\Finance\Models\NullTaxCode
     * @group module
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\Finance\Models\TaxCode', new NullTaxCode());
    }

    /**
     * @covers \Modules\Finance\Models\NullTaxCode
     * @group module
     */
    public function testId() : void
    {
        $null = new NullTaxCode(2);
        self::assertEquals(2, $null->id);
    }

    /**
     * @covers \Modules\Finance\Models\NullTaxCode
     * @group module
     */
    public function testJsonSerialize() : void
    {
        $null = new NullTaxCode(2);
        self::assertEquals(['id' => 2], $null->jsonSerialize());
    }
}
