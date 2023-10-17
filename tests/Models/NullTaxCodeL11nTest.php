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

use Modules\Finance\Models\NullTaxCodeL11n;

/**
 * @internal
 */
final class NullTaxCodeL11nTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Finance\Models\NullTaxCodeL11n
     * @group module
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\Finance\Models\TaxCodeL11n', new NullTaxCodeL11n());
    }

    /**
     * @covers Modules\Finance\Models\NullTaxCodeL11n
     * @group module
     */
    public function testId() : void
    {
        $null = new NullTaxCodeL11n(2);
        self::assertEquals(2, $null->id);
    }

    /**
     * @covers Modules\Finance\Models\NullTaxCodeL11n
     * @group module
     */
    public function testJsonSerialize() : void
    {
        $null = new NullTaxCodeL11n(2);
        self::assertEquals(['id' => 2], $null->jsonSerialize());
    }
}
