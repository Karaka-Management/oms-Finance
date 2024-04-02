<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Accounting
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use phpOMS\Uri\UriFactory;

/**
 * @var \phpOMS\Views\View               $this
 * @var \Modules\Tag\Models\CostCenter[] $taxcode
 */
$taxcode = $this->data['taxcode'];

$previous = empty($taxcode) ? '{/base}/finance/tax/code/list' : '{/base}/finance/tax/code/list?{?}&offset=' . \reset($taxcode)->id . '&ptype=p';
$next     = empty($taxcode) ? '{/base}/finance/tax/code/list' : '{/base}/finance/tax/code/list?{?}&offset=' . \end($taxcode)->id . '&ptype=n';

echo $this->data['nav']->render(); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="portlet">
            <div class="portlet-head"><?= $this->getHtml('TaxCodes'); ?><i class="g-icon download btn end-xs">download</i></div>
            <table class="default sticky">
            <thead>
            <tr>
                <td><?= $this->getHtml('TaxCode'); ?>
                <td class="wf-100"><?= $this->getHtml('Name'); ?>
                <td><?= $this->getHtml('Invoice'); ?>
                <td><?= $this->getHtml('Sales'); ?>
                <td><?= $this->getHtml('Purchase'); ?>
                <td><?= $this->getHtml('Tax1Account'); ?>
                <td><?= $this->getHtml('Tax2Account'); ?>
            <tbody>
            <?php $count = 0;
            foreach ($taxcode as $key => $value) : ++$count;
            $url = UriFactory::build('{/base}/finance/tax/code/view?{?}&id=' . $value->id); ?>
                <tr tabindex="0" data-href="<?= $url; ?>">
                    <td><a href="<?= $url; ?>">
                        <?= $this->printHtml($value->abbr); ?></a>
                    <td><a href="<?= $url; ?>">
                        <?= $this->printHtml($value->l11n->title); ?></a>
                    <td><a href="<?= $url; ?>">
                        <?= $value->percentageInvoice / 10000; ?> %</a>
                    <td><a href="<?= $url; ?>">
                        <?= $value->percentageOutput / 10000; ?> %</a>
                    <td><a href="<?= $url; ?>">
                        <?= $value->percentageInput / 10000; ?> %</a>
                    <td><a href="<?= $url; ?>">
                        <?= $this->printHtml($value->taxAccount1); ?></a>
                    <td><a href="<?= $url; ?>">
                        <?= $this->printHtml($value->taxAccount2); ?></a>
            <?php endforeach; ?>
            <?php if ($count === 0) : ?>
                <tr><td colspan="7" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
            <?php endif; ?>
        </table>
    </div>
</div>
