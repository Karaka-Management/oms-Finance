<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\Finance
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
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
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;

/**
 * Finance class.
 *
 * @package Modules\Finance
 * @license OMS License 2.0
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
        if (($val['abbr'] = !$request->hasData('abbr'))
            || ($val['title'] = !$request->hasData('title'))
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
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiTaxCodeCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateTaxCodeCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $code = $this->createTaxCodeFromRequest($request);
        $this->createModel($request->header->account, $code, TaxCodeMapper::class, 'tax_code', $request->getOrigin());
        $this->createStandardCreateResponse($request, $response, $code);
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
        $code                    = new TaxCode();
        $code->abbr              = $request->getDataString('abbr') ?? '';
        $code->percentageInvoice = $request->getDataInt('percentage_invoice') ?? 0;
        $code->percentageSales   = $request->getDataInt('percentage_sales_tax') ?? 0;
        $code->percentageInput   = $request->getDataInt('percentage_input_tax') ?? 0;

        if ($request->hasData('title')) {
            $code->l11n->title = $request->getDataString('title') ?? '';
            $code->l11n->short = $request->getDataString('short') ?? '';
            $code->l11n->long  = $request->getDataString('long') ?? '';
            $code->l11n->setLanguage($request->getDataString('language') ?? 'en');
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
        if (($val['title'] = !$request->hasData('title'))
            || ($val['code'] = !$request->hasData('code'))
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
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiTaxCodeL11nCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateTaxCodeL11nCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $l11nCode = $this->createTaxCodeL11nFromRequest($request);
        $this->createModel($request->header->account, $l11nCode, TaxCodeL11nMapper::class, 'tax_code_l11n', $request->getOrigin());
        $this->createStandardCreateResponse($request, $response, $l11nCode);
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
        $l11n        = new TaxCodeL11n();
        $l11n->title = $request->getDataString('title') ?? '';
        $l11n->short = $request->getDataString('short') ?? '';
        $l11n->long  = $request->getDataString('long') ?? '';
        $l11n->code  = $request->getDataInt('code') ?? 0;
        $l11n->setLanguage($request->getDataString('language') ?? $request->header->l11n->language);

        return $l11n;
    }

    /**
     * Api method to update TaxCode
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiTaxCodeUpdate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateTaxCodeUpdate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidUpdateResponse($request, $response, $val);

            return;
        }

        /** @var \Modules\Finance\Models\TaxCode $old */
        $old = TaxCodeMapper::get()->where('id', (int) $request->getData('id'))->execute();
        $new = $this->updateTaxCodeFromRequest($request, clone $old);

        $this->updateModel($request->header->account, $old, $new, TaxCodeMapper::class, 'tax_code', $request->getOrigin());
        $this->createStandardUpdateResponse($request, $response, $new);
    }

    /**
     * Method to update TaxCode from request.
     *
     * @param RequestAbstract $request Request
     * @param TaxCode         $new     Model to modify
     *
     * @return TaxCode
     *
     * @todo: implement
     *
     * @since 1.0.0
     */
    public function updateTaxCodeFromRequest(RequestAbstract $request, TaxCode $new) : TaxCode
    {
        $new->abbr              = $request->getDataString('abbr') ?? $new->abbr;
        $new->percentageInvoice = $request->getDataInt('percentage_invoice') ?? $new->percentageInvoice;
        $new->percentageSales   = $request->getDataInt('percentage_sales_tax') ?? $new->percentageSales;
        $new->percentageInput   = $request->getDataInt('percentage_input_tax') ?? $new->percentageInput;

        return $new;
    }

    /**
     * Validate TaxCode update request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @todo: implement
     *
     * @since 1.0.0
     */
    private function validateTaxCodeUpdate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to delete TaxCode
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiTaxCodeDelete(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateTaxCodeDelete($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidDeleteResponse($request, $response, $val);

            return;
        }

        /** @var \Modules\Finance\Models\TaxCode $taxCode */
        $taxCode = TaxCodeMapper::get()->where('id', (int) $request->getData('id'))->execute();
        $this->deleteModel($request->header->account, $taxCode, TaxCodeMapper::class, 'tax_code', $request->getOrigin());
        $this->createStandardDeleteResponse($request, $response, $taxCode);
    }

    /**
     * Validate TaxCode delete request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @todo: implement
     *
     * @since 1.0.0
     */
    private function validateTaxCodeDelete(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to update TaxCodeL11n
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiTaxCodeL11nUpdate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateTaxCodeL11nUpdate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidUpdateResponse($request, $response, $val);

            return;
        }

        /** @var \Modules\Finance\Models\TaxCodeL11n $old */
        $old = TaxCodeL11nMapper::get()->where('id', (int) $request->getData('id'))->execute();
        $new = $this->updateTaxCodeL11nFromRequest($request, clone $old);

        $this->updateModel($request->header->account, $old, $new, TaxCodeL11nMapper::class, 'tax_code_l11n', $request->getOrigin());
        $this->createStandardUpdateResponse($request, $response, $new);
    }

    /**
     * Method to update TaxCodeL11n from request.
     *
     * @param RequestAbstract $request Request
     * @param TaxCodeL11n     $new     Model to modify
     *
     * @return TaxCodeL11n
     *
     * @todo: implement
     *
     * @since 1.0.0
     */
    public function updateTaxCodeL11nFromRequest(RequestAbstract $request, TaxCodeL11n $new) : TaxCodeL11n
    {
        $new->title = $request->getDataString('title') ?? $new->title;
        $new->short = $request->getDataString('short') ?? $new->short;
        $new->long  = $request->getDataString('long') ?? $new->long;
        $new->code  = $request->getDataInt('code') ?? $new->code;
        $new->setLanguage($request->getDataString('language') ?? $new->language);

        return $new;
    }

    /**
     * Validate TaxCodeL11n update request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @todo: implement
     *
     * @since 1.0.0
     */
    private function validateTaxCodeL11nUpdate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to delete TaxCodeL11n
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiTaxCodeL11nDelete(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateTaxCodeL11nDelete($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidDeleteResponse($request, $response, $val);

            return;
        }

        /** @var \Modules\Finance\Models\TaxCodeL11n $taxCodeL11n */
        $taxCodeL11n = TaxCodeL11nMapper::get()->where('id', (int) $request->getData('id'))->execute();
        $this->deleteModel($request->header->account, $taxCodeL11n, TaxCodeL11nMapper::class, 'tax_code_l11n', $request->getOrigin());
        $this->createStandardDeleteResponse($request, $response, $taxCodeL11n);
    }

    /**
     * Validate TaxCodeL11n delete request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @todo: implement
     *
     * @since 1.0.0
     */
    private function validateTaxCodeL11nDelete(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))) {
            return $val;
        }

        return [];
    }
}
