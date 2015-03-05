<?php
/**
 * @package     RedMIGRATOR.Backend
 * @subpackage  Controller
 *
 * @copyright   Copyright (C) 2012 - 2015 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * 
 *  redMIGRATOR is based on JUpgradePRO made by Matias Aguirre
 */

class RedMigratorVirtuemartOrderItem extends RedMigrator
{
    public function dataHook($rows)
    {
        $arrFields = array('virtuemart_order_item_id',
                            'virtuemart_order_id',
                            'virtuemart_vendor_id',
                            'virtuemart_product_id',
                            'order_item_sku',
                            'order_item_name',
                            'product_quantity',
                            'product_item_price',
                            'product_final_price',
                            'order_item_currency',
                            'order_status',
                            'product_attribute',                            
                            'created_on',
                            'modified_on'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['order_item_id']))
            {
                $row['virtuemart_order_item_id'] = $row['order_item_id'];    
            }
            
            if (isset($row['order_id']))
            {
                $row['virtuemart_order_id'] = $row['order_id'];    
            }
            
            if (isset($row['vendor_id']))
            {
                $row['virtuemart_vendor_id'] = $row['vendor_id'];    
            }
            
            if (isset($row['product_id']))
            {
                $row['virtuemart_product_id'] = $row['product_id'];    
            }
            
            if (isset($row['cdate']))
            {
                $row['created_on'] = $row['cdate'];    
            }
            
            if (isset($row['mdate']))
            {
                $row['modified_on'] = $row['mdate'];    
            }

            foreach ($row as $key => $value)
            {
                if (!in_array($key, $arrFields))
                {
                    unset($row[$key]);
                }
            }
        }

        return $rows;
    }
}
?>