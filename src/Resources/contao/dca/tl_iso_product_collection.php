<?php

use MarcoSimbuerger\IsotopeCustomerNotes\Backend\ProductCollection\CollectionLabelCallback;

$GLOBALS['TL_DCA']['tl_iso_product_collection']['list']['label']['fields'][] = 'customer_notes';
$GLOBALS['TL_DCA']['tl_iso_product_collection']['list']['label']['label_callback'] = [CollectionLabelCallback::class, 'getOrderLabel'];

$GLOBALS['TL_DCA']['tl_iso_product_collection']['palettes']['default'] = str_replace
(
    'notes',
    'customer_notes,notes',
    $GLOBALS['TL_DCA']['tl_iso_product_collection']['palettes']['default']
);

$GLOBALS['TL_DCA']['tl_iso_product_collection']['fields']['customer_notes'] = [

    'label'       => &$GLOBALS['TL_LANG']['tl_iso_product_collection']['customer_notes'],
    'exclude'     => TRUE,
    'inputType'   => 'textarea',
    'eval'        => ['style'=>'height:80px;'],
    'sql'         => "text NULL",
];
