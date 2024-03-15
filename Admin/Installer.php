<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\Finance\Admin
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Finance\Admin;

use phpOMS\Application\ApplicationAbstract;
use phpOMS\Config\SettingsInterface;
use phpOMS\Message\Http\HttpRequest;
use phpOMS\Message\Http\HttpResponse;
use phpOMS\Module\InstallerAbstract;
use phpOMS\Module\ModuleInfo;

/**
 * Installer class.
 *
 * @package Modules\Finance\Admin
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
final class Installer extends InstallerAbstract
{
    /**
     * Path of the file
     *
     * @var string
     * @since 1.0.0
     */
    public const PATH = __DIR__;

    /**
     * {@inheritdoc}
     */
    public static function install(ApplicationAbstract $app, ModuleInfo $info, SettingsInterface $cfgHandler) : void
    {
        parent::install($app, $info, $cfgHandler);

        $fileContent = \file_get_contents(__DIR__ . '/Install/taxcodes.json');
        if ($fileContent === false) {
            return;
        }

        /** @var array $taxes */
        $taxes = \json_decode($fileContent, true);
        foreach ($taxes as $type) {
            self::createCode($app, $type);
        }
    }

    /**
     * Install default tax codes
     *
     * @param ApplicationAbstract $app  Application
     * @param array               $data Tax code data
     *
     * @return array
     *
     * @since 1.0.0
     */
    private static function createCode(ApplicationAbstract $app, array $data) : array
    {
        /** @var \Modules\Finance\Controller\ApiController $module */
        $module = $app->moduleManager->get('Finance');

        $response = new HttpResponse();
        $request  = new HttpRequest();

        $request->header->account = 1;
        $request->setData('abbr', $data['abbr'] ?? '');
        $request->setData('percentage_invoice', $data['percentage_invoice'] ?? 0);
        $request->setData('percentage_sales_tax', $data['percentage_sales_tax'] ?? 0);
        $request->setData('tax1', $data['tax1_account'] ?? null);
        $request->setData('tax2', $data['tax2_account'] ?? null);
        $request->setData('percentage_input_tax', $data['percentage_input_tax'] ?? 0);
        $request->setData('title', \reset($data['l11n'])['title'] ?? '');
        $request->setData('short',  \reset($data['l11n'])['short'] ?? '');
        $request->setData('long',  \reset($data['l11n'])['long'] ?? '');
        $request->setData('language', \array_keys($data['l11n'])[0]);

        $module->apiTaxCodeCreate($request, $response);

        $responseData = $response->getData('');
        if (!\is_array($responseData)) {
            return [];
        }

        /** @var \Modules\Finance\Models\TaxCode $code */
        $code = $responseData['response'];
        $id   = $code->id;

        $isFirst = true;
        foreach ($data['l11n'] as $lang => $l11n) {
            if ($isFirst) {
                $isFirst = false;
                continue;
            }

            $response = new HttpResponse();
            $request  = new HttpRequest();

            $request->header->account = 1;
            $request->setData('title', $l11n['title'] ?? '');
            $request->setData('short', $l11n['short'] ?? '');
            $request->setData('long', $l11n['long'] ?? '');
            $request->setData('language', $lang);
            $request->setData('code', $id);

            $module->apiTaxCodeL11nCreate($request, $response);
        }

        return $code->toArray();
    }
}
