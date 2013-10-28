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

class RedMigratorKunenaAnnouncement extends RedMigrator
{
    public function dataHook($rows)
    {
        $arrFields = array('id',
                            'title',
                            'sdescription',
                            'description',
                            'created',
                            'published',
                            'ordering',
                            'showdate'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
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