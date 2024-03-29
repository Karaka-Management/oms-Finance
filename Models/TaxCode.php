<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Finance\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Finance\Models;

/**
 * Finance class.
 *
 * @package Modules\Finance\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class TaxCode implements \JsonSerializable
{
    /**
     * Article ID.
     *
     * @var int
     * @since 1.0.0
     */
    public int $id = 0;

    public string $abbr = '';

    /** @todo Turn into FloatInt */
    public int $percentageInvoice = 0;

    public int $percentageOutput = 0;

    public int $percentageInput = 0;

    // Tax accounts can be defined in:
    //      1. Account (gross postings are automatically split)
    //      2. Tax code
    //      3. Tax combination
    public ?string $taxAccount1 = null;

    public ?string $taxAccount2 = null;

    /**
     * Localization.
     *
     * @var TaxCodeL11n
     * @since 1.0.0
     */
    public TaxCodeL11n $l11n;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->l11n = new TaxCodeL11n();
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id' => $this->id,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : mixed
    {
        return $this->toArray();
    }
}
