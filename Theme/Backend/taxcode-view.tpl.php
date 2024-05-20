<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Accounting
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use Modules\Finance\Models\NullTaxCode;
use phpOMS\Stdlib\Base\FloatInt;
use phpOMS\Uri\UriFactory;

$taxcode = $this->data['taxcode'] ?? new NullTaxCode();
$isNew   = $taxcode->id === 0;

/** @var \phpOMS\Views\View $this */
echo $this->data['nav']->render(); ?>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="portlet">
            <form
                id="iTaxCodeForm"
                method="<?= $isNew ? 'PUT' : 'POST'; ?>"
                action="<?= UriFactory::build('{/api}finance/tax/code?csrf={$CSRF}'); ?>"
                <?= $isNew ? 'data-redirect="' . UriFactory::build('{/base}/finance/tax/code/view') . '?id={/0/response/id}"' : ''; ?>>
                <div class="portlet-head"><?= $this->getHtml('TaxCode'); ?></div>
                <div class="portlet-body">
                    <div class="form-group">
                        <label for="iId"><?= $this->getHtml('ID', '0', '0'); ?></label>
                        <input type="text" name="id" id="iId" value="<?= $taxcode->id; ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="iTaxCode"><?= $this->getHtml('TaxCode'); ?></label>
                        <input type="text" name="abbr" id="iTaxCode" value="<?= $this->printHtml($taxcode->abbr); ?>">
                    </div>

                    <div class="form-group">
                        <label for="iInvoice"><?= $this->getHtml('InvoicePercentage'); ?></label>
                        <input type="number" step="any" name="percentage_invoice" id="iInvoice" value="<?= \number_format($taxcode->percentageInvoice / FloatInt::DIVISOR, 2); ?>">
                    </div>

                    <div class="form-group">
                        <label for="iOutput"><?= $this->getHtml('OutputPercentage'); ?></label>
                        <input type="number" step="any" name="percentage_sales_tax" id="iOutput" value="<?= \number_format($taxcode->percentageOutput / FloatInt::DIVISOR, 2); ?>">
                    </div>

                    <div class="form-group">
                        <label for="iInput"><?= $this->getHtml('InputPercentage'); ?></label>
                        <input type="number" step="any" name="percentage_input_tax" id="iInput" value="<?= \number_format($taxcode->percentageInput / FloatInt::DIVISOR, 2); ?>">
                    </div>

                    <div class="form-group">
                        <label for="iTax1Account"><?= $this->getHtml('Tax1Account'); ?></label>
                        <input type="text" name="tax1" id="iTax1Account" value="<?= $this->printHtml($taxcode->taxAccount1); ?>">
                    </div>

                    <div class="form-group">
                        <label for="iTax2Account"><?= $this->getHtml('Tax2Account'); ?></label>
                        <input type="text" name="tax2" id="iTax2Account" value="<?= $this->printHtml($taxcode->taxAccount2); ?>">
                    </div>
                </div>
                <div class="portlet-foot">
                    <?php if ($isNew) : ?>
                        <input id="iCreateSubmit" type="Submit" value="<?= $this->getHtml('Create', '0', '0'); ?>">
                    <?php else : ?>
                        <input id="iSaveSubmit" type="Submit" value="<?= $this->getHtml('Save', '0', '0'); ?>">
                    <?php endif; ?>
                </div>
            </form>
        </section>
    </div>
</div>

<?php if (!$isNew) : ?>
<!-- @todo implement localization form + table.
        We cannot use the standard l11n form because here we have multiple l11n elements grouped together
-->
<?php endif; ?>
