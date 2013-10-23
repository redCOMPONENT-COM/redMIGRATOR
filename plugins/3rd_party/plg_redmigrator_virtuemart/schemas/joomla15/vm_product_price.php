<?php
/**
 * @package     RedMIGRATOR.Backend
 * @subpackage  Controller
 *
 * @copyright   Copyright (C) 2005 - 2013 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * 
 *  redMIGRATOR is based on JUpgradePRO made by Matias Aguirre
 */

class RedMigratorVirtuemartProductPrice extends RedMigrator
{
    public function dataHook($rows)
    {
        $arrFields = array('virtuemart_product_price_id',
                            'virtuemart_product_id',
                            'product_price',
                            'virtuemart_shoppergroup_id',
                            'product_currency',
                            'created_on',
                            'modified_on',
                            'price_quantity_start',
                            'price_quantity_end'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            $row['virtuemart_product_price_id'] = $row['product_price_id'];
            $row['virtuemart_product_id'] = $row['product_id'];
            $row['virtuemart_shoppergroup_id'] = $row['shopper_group_id'];
            $row['created_on'] = $row['cdate'];
            $row['modified_on'] = $row['mdate'];

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