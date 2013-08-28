<?php

/*
 * @copyright  Copyright (c) 2011 by  ESS-UA.
 */

class Ess_M2ePro_Model_Amazon_Order_ShippingAddress extends Ess_M2ePro_Model_Order_ShippingAddress
{
    public function getRawData()
    {
        return array(
            'buyer_name'     => $this->order->getChildObject()->getBuyerName(),
            'email'          => $this->getBuyerEmail(),
            'recipient_name' => $this->getData('recipient_name'),
            'country_id'     => $this->getData('country_code'),
            'region'         => $this->getData('state'),
            'city'           => $this->getData('city'),
            'postcode'       => $this->getPostalCode(),
            'telephone'      => $this->getPhone(),
            'company'        => $this->getData('company'),
            'street'         => array_filter($this->getData('street'))
        );
    }

    public function hasSameBuyerAndRecipient()
    {
        $rawAddressData = $this->order->getShippingAddress()->getRawData();

        // this might not work with UTF8 symbols
        if (trim(strtolower($rawAddressData['buyer_name'])) == trim(strtolower($rawAddressData['recipient_name']))) {
            return true;
        }

        return false;
    }

    private function getBuyerEmail()
    {
        $email = $this->order->getData('buyer_email');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = str_replace(' ', '-', strtolower($this->order->getChildObject()->getBuyerName()));
            $email .= Ess_M2ePro_Model_Magento_Customer::FAKE_EMAIL_POSTFIX;
        }

        return $email;
    }

    private function getPostalCode()
    {
        $postalCode = $this->getData('postal_code');

        if ($postalCode == '') {
            $postalCode = '0000';
        }

        return $postalCode;
    }

    private function getPhone()
    {
        $phone = $this->getData('phone');

        if ($phone == '') {
            $phone = '0000000000';
        }

        return $phone;
    }

    protected function getState()
    {
        if (!$this->getCountry()->getId() || strtoupper($this->getCountry()->getId()) != 'US') {
            return parent::getState();
        }

        $state = parent::getState();

        preg_match('/[a-zA-Z]+/', $state, $matches);

        if (empty($matches)) {
            throw new LogicException('State in the Shipping Address is empty or invalid.');
        }

        return array_shift($matches);
    }
}