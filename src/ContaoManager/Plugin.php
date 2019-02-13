<?php

namespace IsotopeCustomerNotes\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use IsotopeCustomerNotes\IsotopeCustomerNotes;

/**
 * Class Plugin.
 *
 * @package IsotopeCustomerNotes\ContaoManager
 */
class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(IsotopeCustomerNotes::class)
                ->setLoadAfter([
                    ContaoCoreBundle::class,
                    'isotope',
                ]),
        ];
    }
}
