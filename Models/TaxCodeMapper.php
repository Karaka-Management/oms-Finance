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

use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * TaxCode mapper class.
 *
 * @package Modules\Finance\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
final class TaxCodeMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'tax_code_id'            => ['name' => 'tax_code_id',            'type' => 'int',          'internal' => 'id'],
        'tax_code_abbr'        => ['name' => 'tax_code_abbr',        'type' => 'string',          'internal' => 'abbr'],
        'tax_code_invoice'    => ['name' => 'tax_code_invoice',    'type' => 'int', 'internal' => 'percentageInvoice'],
        'tax_code_sales'    => ['name' => 'tax_code_sales',    'type' => 'int', 'internal' => 'percentageSales'],
        'tax_code_input'    => ['name' => 'tax_code_input',    'type' => 'int', 'internal' => 'percentageInput'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'tax_code';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'tax_code_id';

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:class-string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    public const HAS_MANY = [
        'l11n' => [
            'mapper'   => TaxCodeL11nMapper::class,
            'table'    => 'tax_code_l11n',
            'self'     => 'tax_code_l11n_code',
            'external' => null,
        ],
    ];
}
