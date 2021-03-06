<?php

/*
 * @author     M2E Pro Developers Team
 * @copyright  2011-2015 ESS-UA [M2E Pro]
 * @license    Commercial use is forbidden
 */

class Ess_M2ePro_Model_Observer_Order extends Ess_M2ePro_Model_Observer_Abstract
{
    //########################################

    public function process()
    {
        /** @var Mage_Sales_Model_Order $magentoOrder */
        $magentoOrder = $this->getEvent()->getOrder();

        /** @var Ess_M2ePro_Model_Order $order */
        $order = $magentoOrder->getData(Ess_M2ePro_Model_Order::ADDITIONAL_DATA_KEY_IN_ORDER);

        if (empty($order)) {
            return;
        }

        if ($order->getData('magento_order_id') == $magentoOrder->getId()) {
            return;
        }

        $order->setData('magento_order_id', $magentoOrder->getId());
        $order->save();

        $order->afterCreateMagentoOrder();
    }

    //########################################
}