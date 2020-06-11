<?php

namespace MarcoSimbuerger\IsotopeCustomerNotes\Module;

use Contao\FrontendTemplate;
use Contao\Input;
use Isotope\Isotope;
use Isotope\Interfaces\IsotopeCheckoutStep;
use Isotope\CheckoutStep\CheckoutStep;
use Isotope\Interfaces\IsotopeProductCollection;
use Isotope\Module\Checkout;

/**
 * Class IsotopeCustomerNotes.
 *
 * @package MarcoSimbuerger\IsotopeCustomerNotes
 */
class IsotopeCustomerNotes extends CheckoutStep implements IsotopeCheckoutStep {

    /**
     * Frontend template instance.
     *
     * @var \Contao\FrontendTemplate|\stdClass
     */
    protected $Template;

    /**
     * Load data container and create template.
     *
     * @param Checkout $objModule
     */
    public function __construct(Checkout $objModule) {
        parent::__construct($objModule);

        $this->Template = new FrontendTemplate('iso_checkout_customer_notes');
    }

    /**
     * {@inheritdoc}.
     */
    public function isAvailable(): bool {
        return TRUE;
    }

    /**
     * {@inheritdoc}.
     */
    public function isSkippable(): bool {
        return FALSE;
    }

    /**
     * Generate the checkout step for the customer notes.
     *
     * @return string
     *   The parsed template.
     */
    public function generate(): string {
        // FormTextArea.
        $strClass  = $GLOBALS['TL_FFL']['textarea'];

        /** @var \Contao\FormTextArea $objWidget */
        $objWidget = new $strClass([
            'id'            => $this->getStepClass(),
            'name'          => $this->getStepClass(),
            'mandatory'     => FALSE,
            'value'         => Isotope::getCart()->customer_notes,
            'storeValues'   => TRUE,
            'tableless'     => TRUE,
        ]);

        if (Input::post('FORM_SUBMIT') == $this->objModule->getFormId()) {
            $objWidget->validate();

            if (!$objWidget->hasErrors()) {
                Isotope::getCart()->customer_notes = $objWidget->value;
                Isotope::getCart()->save();
                $this->addNoteToOrder();
            }
        }

        $this->Template->headline = $GLOBALS['TL_LANG']['MSC']['customer_notes'];
        $this->Template->message = $GLOBALS['TL_LANG']['MSC']['customer_notes_message'];
        $this->Template->form = $objWidget->parse();

        return $this->Template->parse();
    }

    /**
     * Return review information for last page of checkout.
     *
     * @return array
     */
    public function review(): array {
        return [
            'customer_notes' => [
                'headline' => $GLOBALS['TL_LANG']['MSC']['customer_notes'],
                'info'     => Isotope::getCart()->customer_notes,
                'note'     => '',
                'edit'     => Checkout::generateUrlForStep('customer_notes'),
            ],
        ];
    }

    /**
     * {@inheritdoc}.
     */
    public function getNotificationTokens(IsotopeProductCollection $objCollection): array {
        return[];
    }

    /**
     * Add customer notes to the order.
     */
    private function addNoteToOrder(): void {
        /** @var string $customerNotes */
        $customerNotes = Isotope::getCart()->customer_notes;
        /** @var \Isotope\Interfaces\IsotopeProductCollection $draftOrder */
        $draftOrder = Isotope::getCart()->getDraftOrder();
        if (!empty($customerNotes) && $draftOrder instanceof IsotopeProductCollection) {
            $draftOrder->customer_notes = $customerNotes;
        }
    }

}
