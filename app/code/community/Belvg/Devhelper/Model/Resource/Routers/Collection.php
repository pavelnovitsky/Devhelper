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

class Belvg_Devhelper_Model_Resource_Routers_Collection
    extends Belvg_Devhelper_Model_Resource_Collection_Abstract {

    /**
     * Available routers
     * @var array
     */
    protected $_scope = array(
            'routers_frontend' => 'frontend/routers',
            'routers_admin' => 'admin/routers',
    );

    /**
     * Prepare collection with passed data
     * @param mixed $data
     */
    public function _prepare($filter = NULL) {
        $config = Mage::getConfig()->getNode($this->_scope[$filter])->children();

        foreach ($config as $node) {
            $path = $this->_scope[$filter] . '/' . $node->getName() . '/args';
            $conf = Mage::getConfig()->getNode($path)->children();
            foreach ($conf->modules as $modules) {
                $module = $modules->children();
                $item = new Varien_Object();
                $item->setTo((string) $module);
                $attributes = $module->attributes();
                $item->setFrom((string) $attributes[0]);
                $item->setDirection((string) $attributes->getName());
                $this->addItem($item);
            }
        }
    }

}
