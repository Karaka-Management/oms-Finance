<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use Modules\Finance\Controller\BackendController;
use Modules\Finance\Models\PermissionCategory;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^/finance/analysis(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Finance\Controller\BackendController:viewDashboard',
            'verb'       => RouteVerb::GET,
            'active' => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::ANALYSIS,
            ],
        ],
    ],
    '^/finance/tax/code/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Finance\Controller\BackendController:viewTaxList',
            'verb'       => RouteVerb::GET,
            'active' => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::TAX,
            ],
        ],
    ],
    '^/finance/tax/code/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Finance\Controller\BackendController:viewTaxCode',
            'verb'       => RouteVerb::GET,
            'active' => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::TAX,
            ],
        ],
    ],
    '^/finance/tax/code/create(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Finance\Controller\BackendController:viewTaxCreate',
            'verb'       => RouteVerb::GET,
            'active' => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::TAX,
            ],
        ],
    ],
];
