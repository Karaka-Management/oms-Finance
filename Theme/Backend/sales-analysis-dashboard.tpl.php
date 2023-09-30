<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\Billing
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use phpOMS\Localization\Money;

/**
 * @var \phpOMS\Views\View $this
 */

echo $this->data['nav']->render();
?>

<div class="row">
    <div class="col-xs-12 col-lg-4">
        <section class="portlet">
            <div class="portlet-body">
                <h2><?= $this->getHtml('Current'); ?></h2>
                <div class="form-group">
                    <div class="input-control">
                        <label for="iOname"><?= $this->getHtml('Start'); ?></label>
                        <input type="date">
                    </div>

                    <div class="input-control">
                        <label for="iOname"><?= $this->getHtml('End'); ?></label>
                        <input type="date">
                    </div>
                </div>

                <h2><?= $this->getHtml('Comparison'); ?></h2>
                <div class="form-group">
                    <div class="input-control">
                        <label for="iOname"><?= $this->getHtml('Start'); ?></label>
                        <input type="date">
                    </div>

                    <div class="input-control">
                        <label for="iOname"><?= $this->getHtml('End'); ?></label>
                        <input type="date">
                    </div>
                </div>
            </div>
            <div class="portlet-foot">
                <input id="iSubmitGeneral" name="submitGeneral" type="submit" value="<?= $this->getHtml('Analyze'); ?>">
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-lg-4">
        <section class="portlet highlight-2">
            <div class="portlet-head">Actual</div>
            <div class="portlet-body">
                <div class="form-group">
                    <div>Sales MTD:</div>
                    <div>+12.0 %</div>
                </div>

                <div class="form-group">
                    <div>Sales YTD:</div>
                    <div>+1.2 %</div>
                </div>

                <div class="form-group">
                    <div>Gross Profit Current:</div>
                    <div>+12.0 %</div>
                </div>

                <div class="form-group">
                    <div>Gross Profit Previous:</div>
                    <div>+1.2 %</div>
                </div>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-lg-4">
        <section class="portlet highlight-3">
            <div class="portlet-head">Budget</div>
            <div class="portlet-body">
                <div class="form-group">
                    <div>Sales MTD:</div>
                    <div>+12.0 %</div>
                </div>

                <div class="form-group">
                    <div>Sales YTD:</div>
                    <div>+1.2 %</div>
                </div>

                <div class="form-group">
                    <div>Gross Profit Current:</div>
                    <div>+12.0 %</div>
                </div>

                <div class="form-group">
                    <div>Gross Profit Budget:</div>
                    <div>+1.2 %</div>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-lg-6">
        <section class="portlet">
            <div class="portlet-head">
                Sales / Profit - Monthly
                <?php include __DIR__ . '/../../../../Web/Backend/Themes/popup-export-data.tpl.php'; ?>
            </div>
            <?php $salesCustomer = $this->data['monthlySalesCustomer']; ?>
            <div class="portlet-body">
                <canvas id="sales-region" data-chart='{
                                "type": "bar",
                                "data": {
                                    "labels": [
                                        <?php
                                            $temp = [];
                                            foreach ($salesCustomer as $monthly) {
                                                $temp[] = $monthly['month'] . '/' . \substr((string) $monthly['year'], -2);
                                            }
                                        ?>
                                        <?= '"' . \implode('", "', $temp) . '"'; ?>
                                    ],
                                    "datasets": [
                                        {
                                            "label": "<?= $this->getHtml('Profit'); ?>",
                                            "type": "line",
                                            "data": [
                                                <?php
                                                    $temp = [];
                                                    foreach ($salesCustomer as $monthly) {
                                                        $temp[] = ((int) $monthly['customers']);
                                                    }
                                                ?>
                                                <?= \implode(',', $temp); ?>
                                            ],
                                            "yAxisID": "axis-2",
                                            "fill": false,
                                            "borderColor": "rgb(255, 99, 132)",
                                            "backgroundColor": "rgb(255, 99, 132)",
                                            "tension": 0.0
                                        },
                                        {
                                            "label": "<?= $this->getHtml('Sales'); ?>",
                                            "type": "bar",
                                            "data": [
                                                <?php
                                                    $temp = [];
                                                    foreach ($salesCustomer as $monthly) {
                                                        $temp[] = ((int) $monthly['net_sales']) / 1000;
                                                    }
                                                ?>
                                                <?= \implode(',', $temp); ?>
                                            ],
                                            "yAxisID": "axis-1",
                                            "fill": false,
                                            "borderColor": "rgb(54, 162, 235)",
                                            "backgroundColor": "rgb(54, 162, 235)",
                                            "tension": 0.0
                                        }
                                    ]
                                },
                                "options": {
                                    "title": {
                                        "display": false,
                                        "text": "Sales / Profit"
                                    },
                                    "scales": {
                                        "yAxes": [
                                            {
                                                "id": "axis-1",
                                                "display": true,
                                                "position": "left"
                                            },
                                            {
                                                "id": "axis-2",
                                                "display": true,
                                                "position": "right",
                                                "scaleLabel": {
                                                    "display": true,
                                                    "labelString": "<?= $this->getHtml('Profit'); ?>"
                                                },
                                                "gridLines": {
                                                    "display": false
                                                }
                                            }
                                        ]
                                    }
                                }
                        }'></canvas>
                <div class="more-container">
                    <input id="more-customer-sales" type="checkbox" name="more-container">
                    <label for="more-customer-sales">
                        <span>Data</span>
                        <i class="fa fa-chevron-right expand"></i>
                    </label>
                    <div>
                    <table class="default">
                        <thead>
                            <tr>
                                <td>Month
                                <td>Sales
                                <td>Customer count
                        <tbody>
                            <?php
                                $sum1 = 0;
                                $sum2 = 0;
                            foreach ($salesCustomer as $values) :
                                $sum1 += ((int) $values['net_sales']) / 1000;
                                $sum2 += ((int) $values['customers']);
                            ?>
                                <tr>
                                    <td><?= $values['month'] . '/' . \substr((string) $values['year'], -2); ?>
                                    <td><?= (new Money(((int) $values['net_sales']) / 10000))->getCurrency(); ?>
                                    <td><?= ((int) $values['customers']); ?>
                            <?php endforeach; ?>
                                <tr>
                                    <td>Total
                                    <td><?= (new Money($sum1))->getCurrency(); ?>
                                    <td><?= (int) ($sum2 / 12); ?>
                    </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-lg-6">
        <section class="portlet">
            <div class="portlet-head">
                Sales / Profit - Annual
                <?php include __DIR__ . '/../../../../Web/Backend/Themes/popup-export-data.tpl.php'; ?>
            </div>
            <?php $salesCustomer = $this->data['annualSalesCustomer']; ?>
            <div class="portlet-body">
                <canvas id="sales-customer-annual" data-chart='{
                                "type": "bar",
                                "data": {
                                    "labels": [
                                        <?php
                                            $temp = [];
                                            foreach ($salesCustomer as $annual) {
                                                $temp[] = $annual['year'];
                                            }
                                        ?>
                                        <?= '"' . \implode('", "', $temp) . '"'; ?>
                                    ],
                                    "datasets": [
                                        {
                                            "label": "<?= $this->getHtml('Profit'); ?>",
                                            "type": "line",
                                            "data": [
                                                <?php
                                                    $temp = [];
                                                    foreach ($salesCustomer as $annual) {
                                                        $temp[] = ((int) $annual['customers']);
                                                    }
                                                ?>
                                                <?= \implode(',', $temp); ?>
                                            ],
                                            "yAxisID": "axis-2",
                                            "fill": false,
                                            "borderColor": "rgb(255, 99, 132)",
                                            "backgroundColor": "rgb(255, 99, 132)",
                                            "tension": 0.0
                                        },
                                        {
                                            "label": "<?= $this->getHtml('Sales'); ?>",
                                            "type": "bar",
                                            "data": [
                                                <?php
                                                    $temp = [];
                                                    foreach ($salesCustomer as $annual) {
                                                        $temp[] = ((int) $annual['net_sales']) / 1000;
                                                    }
                                                ?>
                                                <?= \implode(',', $temp); ?>
                                            ],
                                            "yAxisID": "axis-1",
                                            "fill": false,
                                            "borderColor": "rgb(54, 162, 235)",
                                            "backgroundColor": "rgb(54, 162, 235)",
                                            "tension": 0.0
                                        }
                                    ]
                                },
                                "options": {
                                    "title": {
                                        "display": false,
                                        "text": "Sales / Profit"
                                    },
                                    "scales": {
                                        "yAxes": [
                                            {
                                                "id": "axis-1",
                                                "display": true,
                                                "position": "left"
                                            },
                                            {
                                                "id": "axis-2",
                                                "display": true,
                                                "position": "right",
                                                "scaleLabel": {
                                                    "display": true,
                                                    "labelString": "<?= $this->getHtml('Profit'); ?>"
                                                },
                                                "gridLines": {
                                                    "display": false
                                                }
                                            }
                                        ]
                                    }
                                }
                        }'></canvas>
                <div class="more-container">
                    <input id="more-customer-sales-annual" type="checkbox" name="more-container">
                    <label for="more-customer-sales-annual">
                        <span>Data</span>
                        <i class="fa fa-chevron-right expand"></i>
                    </label>
                    <div>
                    <table class="default">
                        <thead>
                            <tr>
                                <td>Year
                                <td>Sales
                                <td>Customer count
                        <tbody>
                            <?php
                            foreach ($salesCustomer as $values) :
                            ?>
                                <tr>
                                    <td><?= (string) $values['year']; ?>
                                    <td><?= (new Money(((int) $values['net_sales']) / 10000))->getCurrency(); ?>
                                    <td><?= ((int) $values['customers']); ?>
                            <?php endforeach; ?>
                    </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <section class="portlet">
            <div class="portlet-head">
                Sales / Attribute
                <?php include __DIR__ . '/../../../../Web/Backend/Themes/popup-export-data.tpl.php'; ?>
            </div>
            <table class="default">
                <thead>
                    <tr>
                        <td>Product
                        <td>Sales PY
                        <td>Sales B
                        <td>Sales A
                        <td>Diff PY
                        <td>Diff B
                <tbody>
            </table>
       </section>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <section class="portlet">
            <div class="portlet-head">
                Sales / Region
                <?php include __DIR__ . '/../../../../Web/Backend/Themes/popup-export-data.tpl.php'; ?>
            </div>
            <table class="default">
                <thead>
                    <tr>
                        <td>Country
                        <td>Sales PY
                        <td>Sales B
                        <td>Sales A
                        <td>Diff PY
                        <td>Diff B
                <tbody>
            </table>
       </section>
    </div>
</div>