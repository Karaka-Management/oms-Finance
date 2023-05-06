<?php
/**
 * Karaka
 *
 * PHP Version 8.1
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

    public int $percentageInvoice = 0;

    public int $percentageSales = 0;

    public int $percentageInput = 0;

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
     * Get id
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'    => $this->id,
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
