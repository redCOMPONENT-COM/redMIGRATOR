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

class RedMigratorVirtuemartModule extends RedMigrator
{
    public function dataHook($rows)
    {
        $arrFields = array('module_id',
                            'module_name',
                            'module_description',
                            'module_perms',
                            'published',
                            'ordering'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['module_publish']))
            {
                if ($row['module_publish'] == 'Y')
                {
                    $row['published'] = 1;
                }
                else
                {
                    $row['published'] = 0;
                } 
            }
            
            if (isset($row['list_order']))
            {
                $row['ordering'] = $row['list_order'];    
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