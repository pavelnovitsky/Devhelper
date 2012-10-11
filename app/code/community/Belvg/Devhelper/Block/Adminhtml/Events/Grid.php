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

class Belvg_Devhelper_Block_Adminhtml_Events_Grid
    extends Belvg_Devhelper_Block_Adminhtml_Devhelper_Grid {

    /**
     * List of available event scopes
     * @var array
     */
    protected $_scope = array(
            'global',
            'frontend',
            'adminhtml',
    );

    /**
     * Grid settings
     */
    public function __construct() {
        parent::__construct();
        $this->setId('devhelperGrid');
        $this->_filterVisibility = FALSE;
        $this->_pagerVisibility = FALSE;
    }

    /**
     * Prepare collection
     * @return Mage_Adminhtml_Block_Widget
     */
    protected function _prepareCollection() {

        $collection = Mage::getResourceModel('devhelper/events_collection');
        $data = array();

        foreach ($this->_scope as $scope) {
            $data = array_merge(
                    $data, $collection->_prepareData($scope)
            );
        }

        $collection->_prepare($data);

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Define grid columns
     * @return Mage_Adminhtml_Block_Widget
     */
    protected function _prepareColumns() {
        $this->addColumn('name', array(
                'header' => $this->_helper->__('Name'),
                'align' => 'left',
                'index' => 'name',
                'sortable' => FALSE,
        ));

        $this->addColumn('path', array(
                'header' => $this->_helper->__('Path'),
                'align' => 'left',
                'index' => 'path',
                'sortable' => FALSE,
        ));

        $this->addColumn('class', array(
                'header' => $this->_helper->__('Class'),
                'align' => 'left',
                'index' => 'class',
                'sortable' => FALSE,
        ));

        $this->addColumn('method', array(
                'header' => $this->_helper->__('Method'),
                'align' => 'left',
                'index' => 'method',
                'sortable' => FALSE,
        ));

        $this->addColumn('path', array(
                'header' => $this->_helper->__('Path'),
                'align' => 'left',
                'index' => 'path',
                'sortable' => FALSE,
        ));

        $this->addColumn('scope', array(
                'header' => $this->_helper->__('Scope'),
                'align' => 'left',
                'index' => 'scope',
                'sortable' => FALSE,
        ));

        return parent::_prepareColumns();
    }

    /**
     *
     * @param Mage_Catalog_Model_Product|Varien_Object $row
     * @return NULL
     */
    public function getRowUrl($row) {
        return NULL;
    }

}
