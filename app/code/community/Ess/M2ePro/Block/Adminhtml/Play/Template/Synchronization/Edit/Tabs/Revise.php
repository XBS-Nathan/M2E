<?php

/*
 * @copyright  Copyright (c) 2013 by  ESS-UA.
 */

class Ess_M2ePro_Block_Adminhtml_Play_Template_Synchronization_Edit_Tabs_Revise extends Mage_Adminhtml_Block_Widget
{
    public function __construct()
    {
        parent::__construct();

        // Initialization block
        //------------------------------
        $this->setId('playTemplateSynchronizationEditTabsRevise');
        //------------------------------

        $this->setTemplate('M2ePro/play/template/synchronization/revise.phtml');
    }
}