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

class RedMigratorVirtuemartUserField extends RedMigrator
{
    public function dataHook($rows)
    {
        $arrFields = array('virtuemart_userfield_id',
                            'virtuemart_vendor_id',
                            'shipment',
                            'name',
                            'title',
                            'description',
                            'type',
                            'maxlength',
                            'size',
                            'required',
                            'ordering',
                            'cols',
                            'rows',
                            'value',
                            'default',
                            'published',
                            'registration',
                            'account',
                            'readonly',
                            'calculated',
                            'sys',
                            'params'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['fieldid']))
            {
                $row['virtuemart_userfield_id'] = $row['fieldid'];    
            }
            
            if (isset($row['vendor_id']))
            {
                $row['virtuemart_vendor_id'] = $row['vendor_id'];    
            }
            
            if (isset($row['shipping']))
            {
                $row['shipment'] = $row['shipping'];    
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