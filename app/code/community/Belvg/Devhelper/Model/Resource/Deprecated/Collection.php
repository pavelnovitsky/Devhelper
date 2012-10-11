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

class Belvg_Devhelper_Model_Resource_Deprecated_Collection
    extends Belvg_Devhelper_Model_Resource_Collection_Abstract {

    /**
     * Prepare collection with passed data
     * @param mixed $data
     */
    public function _prepare($data = NULL) {

        $config = Mage::getConfig()->getNode('global/rewrite');

        if ($config) {
            foreach ($config->children() as $node) {
                $item = new Varien_Object();
                $item->setTo($node->to);
                $item->setFrom($node->from);
                $item->setClass($node->getName());
                $this->addItem($item);
            }
        }
    }

}
