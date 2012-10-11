<?php

/**
 * BelVG LLC.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt
 *
  /***************************************
 *         MAGENTO EDITION USAGE NOTICE *
 * *************************************** */
/* This package designed for Magento COMMUNITY edition
 * BelVG does not guarantee correct work of this extension
 * on any other Magento edition except Magento COMMUNITY edition.
 * BelVG does not provide extension support in case of
 * incorrect edition usage.
  /***************************************
 *         DISCLAIMER   *
 * *************************************** */
/* Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future.
 * ****************************************************
 * @category   Belvg
 * @package    Belvg_Devhelper
 * @author Pavel Novitsky <pavel@belvg.com>
 * @copyright  Copyright (c) 2010 - 2012 BelVG LLC. (http://www.belvg.com)
 * @license    http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt
 */

class Belvg_Devhelper_Adminhtml_DevhelperController
    extends Mage_Adminhtml_Controller_Action {

    /**
     * Helper instance
     * @var Belvg_Devhelper_Helper_Data
     */
    protected $_helper;

    /**
     * Save helper instance
     */
    public function _construct() {
        $this->_helper = Mage::helper('devhelper');
    }

    /**
     * Get request variable filter, set active menu, set main header
     * @return Belvg_Devhelper_Adminhtml_DevhelperController
     */
    protected function _initAction() {
        $filter = $this->getRequest()->getParam('filter', 'models');
        Mage::register('filter', $filter);

        $this->loadLayout()
                ->_setActiveMenu('system/devhelper')
                ->_title($this->_helper->__('Dev. Helper'));

        return $this;
    }

    /**
     * Get list of Model, Helper and Block rewrites
     */
    public function devhelperAction() {
        $this->_initAction()
                ->_title($this->_helper->__('Rewrites'))
                ->_title($this->_helper->__(ucfirst(strtolower(Mage::registry('filter')))));

        $this->_addContent($this->getLayout()->createBlock('devhelper/adminhtml_rewrites_devhelper'));
        $this->renderLayout();
    }

    /**
     * Get list of routes from/to rewrites
     */
    public function routersdeprecatedAction() {
        $this->_initAction()
                ->_title($this->_helper->__('Rewrites'))
                ->_title($this->_helper->__('Roters'))
                ->_title($this->_helper->__('From To'));

        $this->_addContent($this->getLayout()->createBlock('devhelper/adminhtml_rewrites_routers_deprecated'));
        $this->renderLayout();
    }

    /**
     * Get list of Admin and Frontend routers rewrites
     */
    public function routersAction() {

        $this->_initAction()
                ->_title($this->_helper->__('Rewrites'));
        // for routers_admin, routers_frontend filters
        $filter_parts = explode('_', Mage::registry('filter'));
        foreach ($filter_parts as $part) {
            $this->_title($this->_helper->__(ucfirst(strtolower($part))));
        }

        $this->_addContent($this->getLayout()->createBlock('devhelper/adminhtml_rewrites_routers_routers'));
        $this->renderLayout();
    }

    /**
     * Get list of existing observers
     */
    public function eventsAction() {
        $this->_initAction()
                ->_title($this->_helper->__('Events'));

        $this->_addContent($this->getLayout()->createBlock('devhelper/adminhtml_events'));
        $this->renderLayout();
    }

    /**
     * Check ACL rules
     * @return bool
     */
    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')
                        ->isAllowed('system/devhelper');
    }

}