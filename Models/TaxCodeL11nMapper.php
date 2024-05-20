<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Finance\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
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
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of TaxCodeL11n
 * @extends DataMapperFactory<T>
 */
final class TaxCodeL11nMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'tax_code_l11n_id'         => ['name' => 'tax_code_l11n_id',            'type' => 'int',          'internal' => 'id'],
        'tax_code_l11n_text_title' => ['name' => 'tax_code_l11n_text_title',        'type' => 'string',          'internal' => 'title'],
        'tax_code_l11n_text_short' => ['name' => 'tax_code_l11n_text_short',        'type' => 'string',          'internal' => 'short'],
        'tax_code_l11n_text_long'  => ['name' => 'tax_code_l11n_text_long',    'type' => 'string', 'internal' => 'long'],
        'tax_code_l11n_lang'       => ['name' => 'tax_code_l11n_lang',    'type' => 'string', 'internal' => 'language'],
        'tax_code_l11n_code'       => ['name' => 'tax_code_l11n_code',    'type' => 'int', 'internal' => 'code'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'tax_code_l11n';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'tax_code_l11n_id';
}
