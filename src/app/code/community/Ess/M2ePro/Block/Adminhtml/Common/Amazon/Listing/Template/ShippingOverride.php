<?php

/*
 * @copyright  Copyright (c) 2013 by  ESS-UA.
 */

class Ess_M2ePro_Block_Adminhtml_Common_Amazon_Listing_Template_ShippingOverride
    extends Ess_M2ePro_Block_Adminhtml_Widget_Container
{
    protected $messages = array();

    // ####################################

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('M2ePro/common/amazon/listing/template/shipping_override/main.phtml');
    }

    // ####################################

    /**
     * @param array $messages
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    // ####################################

    public function getWarnings()
    {
        $warnings = '';
        foreach ($this->getMessages() as $message) {
            $warnings .= <<<HTML
<ul class="messages">
    <li class="{$message['type']}-msg">
        <ul>
            <li>{$message['text']}</li>
        </ul>
    </li>
</ul>
HTML;
        }
        return $warnings;
    }

    // ####################################
}