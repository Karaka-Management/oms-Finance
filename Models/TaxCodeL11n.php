<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Finance\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Finance\Models;

use phpOMS\Localization\ISO639x1Enum;

/**
 * Localization of the item class.
 *
 * @package Modules\Finance\Models
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 */
class TaxCodeL11n implements \JsonSerializable
{
    /**
     * Article ID.
     *
     * @var int
     * @since 1.0.0
     */
    public int $id = 0;

    /**
     * Tax code ID.
     *
     * @var int
     * @since 1.0.0
     */
    public int $code = 0;

    /**
     * Language.
     *
     * @var string
     * @since 1.0.0
     */
    public string $language = ISO639x1Enum::_EN;

    /**
     * Title.
     *
     * @var string
     * @since 1.0.0
     */
    public string $title = '';

    /**
     * Title.
     *
     * @var string
     * @since 1.0.0
     */
    public string $short = '';

    /**
     * Title.
     *
     * @var string
     * @since 1.0.0
     */
    public string $long = '';

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
    }

    /**
     * Get language
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getLanguage() : string
    {
        return $this->language;
    }

    /**
     * Set language
     *
     * @param string $language Language
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setLanguage(string $language) : void
    {
        $this->language = $language;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'       => $this->id,
            'title'    => $this->title,
            'short'    => $this->short,
            'long'     => $this->long,
            'language' => $this->language,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : mixed
    {
        return $this->toArray();
    }
}
