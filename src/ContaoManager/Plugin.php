<?php

namespace MarcoSimbuerger\IsotopeCustomerNotesBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use MarcoSimbuerger\IsotopeCustomerNotesBundle\IsotopeCustomerNotesBundle;

/**
 * Class Plugin.
 *
 * @package MarcoSimbuerger\IsotopeCustomerNotesBundle\ContaoManager
 */
class Plugin implements BundlePluginInterface {

    /**
     * {@inheritdoc}.
     */
    public function getBundles(ParserInterface $parser) {
        return [
            BundleConfig::create(IsotopeCustomerNotesBundle::class)
                ->setLoadAfter([
                    ContaoCoreBundle::class,
                    'isotope',
                ]),
        ];
    }

}
