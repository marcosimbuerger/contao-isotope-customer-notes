<?php

// Add customer notes before the last step (review).
$checkoutStepCount = count($GLOBALS['ISO_CHECKOUTSTEP']);
$length = $checkoutStepCount - 1;
$offset = $checkoutStepCount - 1;
$customerNotes = ['customer_notes' => ['\IsotopeCustomerNotes\Module\IsotopeCustomerNotes']];
$newCheckoutSteps = array_slice($GLOBALS['ISO_CHECKOUTSTEP'], 0, $length, TRUE) + $customerNotes + array_slice($GLOBALS['ISO_CHECKOUTSTEP'], $offset, $length, TRUE);
$GLOBALS['ISO_CHECKOUTSTEP'] = $newCheckoutSteps;
