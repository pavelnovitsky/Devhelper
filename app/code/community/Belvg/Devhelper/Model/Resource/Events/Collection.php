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

class Belvg_Devhelper_Model_Resource_Events_Collection
    extends Belvg_Devhelper_Model_Resource_Collection_Abstract {

    /**
     * Format data array for the selected event scope
     * @param string $scope
     * @return array
     */
    public function _prepareData($scope) {
        $config = Mage::getConfig()->getNode($scope . '/events')->children();
        $data = array();

        foreach ($config as $node) {
            $event_name = $node->getName();

            foreach ($node->observers->children() as $observer) {
                $data[$event_name][] = array(
                        'name' => $event_name,
                        'path' => (string) $observer->class,
                        'class' => Mage::getConfig()->getModelClassName((string) $observer->class),
                        'method' => (string) $observer->method,
                        'scope' => $scope
                );
            }
        }
        
        return $data;
    }

    /**
     * Prepare collection with passed data
     * @param mixed $data
     */
    public function _prepare($data = NULL) {
        foreach ($data as $rows) {
            foreach ($rows as $row) {
                $item = new Varien_Object();
                $item->setData($row);
                $this->addItem($item);
            }
        }
    }
}
