<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Sales
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Finance\Controller;

use Modules\Finance\Models\TaxCodeMapper;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Finance class.
 *
 * @package Modules\Finance
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 * @codeCoverageIgnore
 */
final class BackendController extends Controller
{
    /**
     * Method which shows the sales dashboard
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface Response can be rendered
     *
     * @since 1.0.0
     */
    public function viewTaxList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Finance/Theme/Backend/taxcode-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1008102001, $request, $response);

        $view->data['taxcode'] = TaxCodeMapper::getAll()
            ->executeGetArray();

        return $view;
    }

    /**
     * Method which shows the sales dashboard
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface Response can be rendered
     *
     * @since 1.0.0
     */
    public function viewTaxCode(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Finance/Theme/Backend/taxcode-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1008102001, $request, $response);

        $view->data['taxcode'] = TaxCodeMapper::get()
            ->where('id', (int) $request->getData('id'))
            ->execute();

        return $view;
    }

    /**
     * Method which shows the sales dashboard
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface Response can be rendered
     *
     * @since 1.0.0
     */
    public function viewTaxCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Finance/Theme/Backend/taxcode-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1008102001, $request, $response);

        return $view;
    }
}
