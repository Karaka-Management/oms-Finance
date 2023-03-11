<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules\Finance
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Finance\Controller;

use Modules\Finance\Models\TaxCode;
use Modules\Finance\Models\TaxCodeL11n;
use Modules\Finance\Models\TaxCodeL11nMapper;
use Modules\Finance\Models\TaxCodeMapper;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Message\NotificationLevel;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Message\FormValidation;

/**
 * Finance class.
 *
 * @package Modules\Finance
 * @license OMS License 1.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
final class ApiController extends Controller
{
    /**
     * Validate document create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateTaxCodeCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['abbr'] = empty($request->getData('abbr')))
            || ($val['title'] = empty($request->getData('title')))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create document
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiTaxCodeCreate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        if (!empty($val = $this->validateTaxCodeCreate($request))) {
            $response->set('tax_code_create', new FormValidation($val));
            $response->header->status = RequestStatusCode::R_400;

            return;
        }

        $code = $this->createTaxCodeFromRequest($request);
        $this->createModel($request->header->account, $code, TaxCodeMapper::class, 'tax_code', $request->getOrigin());

        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Code', 'Tax code successfully created', $code);
    }

    /**
     * Method to create task from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return TaxCode
     *
     * @since 1.0.0
     */
    private function createTaxCodeFromRequest(RequestAbstract $request) : TaxCode
    {
        $code       = new TaxCode();
        $code->abbr = (string) ($request->getData('abbr') ?? '');
        $code->percentageInvoice = (int) ($request->getData('percentage_invoice') ?? 0);
        $code->percentageSales = (int) ($request->getData('percentage_sales_tax') ?? 0);
        $code->percentageInput = (int) ($request->getData('percentage_input_tax') ?? 0);

        if (!empty($request->getData('title'))) {
            $code->l11n->title = (string) ($request->getData('title') ?? '');
            $code->l11n->short = (string) ($request->getData('short') ?? '');
            $code->l11n->long = (string) ($request->getData('long') ?? '');
            $code->l11n->setLanguage((string) ($request->getData('language') ?? 'en'));
        }

        return $code;
    }

    /**
     * Validate l11n create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateTaxCodeL11nCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
            || ($val['code'] = empty($request->getData('code')))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create tag localization
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiTaxCodeL11nCreate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        if (!empty($val = $this->validateTaxCodeL11nCreate($request))) {
            $response->set('tax_code_l11n_create', new FormValidation($val));
            $response->header->status = RequestStatusCode::R_400;

            return;
        }

        $l11nCode = $this->createTaxCodeL11nFromRequest($request);
        $this->createModel($request->header->account, $l11nCode, TaxCodeL11nMapper::class, 'tax_code_l11n', $request->getOrigin());

        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'Localization', 'Localization successfully created', $l11nCode);
    }

    /**
     * Method to create tag localization from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return TaxCodeL11n
     *
     * @since 1.0.0
     */
    private function createTaxCodeL11nFromRequest(RequestAbstract $request) : TaxCodeL11n
    {
        $l11n          = new TaxCodeL11n();
        $l11n->title = (string) ($request->getData('title') ?? '');
        $l11n->short = (string) ($request->getData('short') ?? '');
        $l11n->long = (string) ($request->getData('long') ?? '');
        $l11n->code = (int) ($request->getData('code') ?? 0);
        $l11n->setLanguage((string) ($request->getData('language') ?? $request->getLanguage()));

        return $l11n;
    }
}
