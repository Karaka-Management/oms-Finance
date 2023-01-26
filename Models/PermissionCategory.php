<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules\Finance\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Finance\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package Modules\Finance\Models
 * @license OMS License 1.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
abstract class PermissionCategory extends Enum
{
    public const ARCHIVE = 1;

    public const ANALYSIS = 2;
}
