<?php

namespace IsotopeCustomerNotes\Backend\ProductCollection;

use Isotope\Backend\ProductCollection\Callback;
use Isotope\Model\ProductCollection\Order;

/**
 * Class CollectionLabelCallback.
 *
 * Extends the label callback functionality of the product collection overview (orders).
 *
 * @package IsotopeCustomerNotes\Backend\ProductCollection
 */
class CollectionLabelCallback extends Callback {

    /**
     * {@inheritdoc}.
     */
    public function getOrderLabel($row, $label, \DataContainer $dc, $args) {
        $args = parent::getOrderLabel($row, $label, $dc, $args);
        // Remove the last entry (the note text).
        array_pop($args);

        $objOrder = Order::findByPk($row['id']);
        $labelMarkup = '<span style="display: block; text-align: center;"><img src="system/themes/flexible/icons/ICONNAME.svg" width="16" height="16"></span>';
        if (!empty($objOrder->customer_notes)) {
            $args[] = str_replace('ICONNAME', 'ok', $labelMarkup);
        }
        else {
            $args[] = str_replace('ICONNAME', 'delete', $labelMarkup);
        }

        return $args;
    }

}
