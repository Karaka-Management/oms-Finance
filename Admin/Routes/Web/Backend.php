<?php
/**
 * Jingga
 *
 * PHP Version 8.1
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
    '^.*/finance/analysis(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Finance\Controller\BackendController:viewDashboard',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::ANALYSIS,
            ],
        ],
    ],
    '^.*/finance/tax/code/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Finance\Controller\BackendController:viewTaxList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::TAX,
            ],
        ],
    ],
    '^.*/finance/tax/code/create(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Finance\Controller\BackendController:viewTaxCreate',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::TAX,
            ],
        ],
    ],
    '^.*/finance/tax/combination/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Finance\Controller\BackendController:viewCombinationList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::TAX,
            ],
        ],
    ],
    '^.*/finance/tax/combination/create(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Finance\Controller\BackendController:viewCombinationCreate',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::TAX,
            ],
        ],
    ],
];
