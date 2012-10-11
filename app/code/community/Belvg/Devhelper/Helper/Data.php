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

class Belvg_Devhelper_Helper_Data extends Mage_Core_Helper_Abstract {

    /**
     * Build title string according to the request param "filter"
     * @return string
     */
    public function getTitleByFilter() {
        $title = array();
        $title[] = $this->__('Dev. Helper');
        // for routers_admin, routers_frontend filters
        if ($filter = Mage::registry('filter')) {
            $title[] = $this->__('Rewrites');

            $filter_parts = explode('_', $filter);
            foreach ($filter_parts as $part) {
                $title[] = $this->__(ucfirst(strtolower($part)));
            }
        } else {
            $title[] = $this->__('Item Manager');
        }
        
        return implode(' / ', $title);
    }

    /**
     * Get saved request param "filter"
     * @return string
     */
    public function getFilter() {
        if (!$filter = Mage::registry('filter')) {
            $filter = 'models';
        }

        return $filter;
    }

}