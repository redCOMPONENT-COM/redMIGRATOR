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

class RedMigratorVirtuemartUserFieldValue extends RedMigrator
{
    public function dataHook($rows)
    {
        $arrFields = array('virtuemart_userfield_value_id',
                            'virtuemart_userfield_id',
                            'fieldtitle',
                            'fieldvalue',
                            'ordering',
                            'sys'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['fieldvalueid']))
            {
                $row['virtuemart_userfield_value_id'] = $row['fieldvalueid'];    
            }
            
            if (isset($row['fieldid']))
            {
                $row['virtuemart_userfield_id'] = $row['fieldid'];    
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