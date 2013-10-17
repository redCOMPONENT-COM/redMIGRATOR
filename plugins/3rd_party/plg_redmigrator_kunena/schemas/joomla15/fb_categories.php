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

class RedMigratorKunenaCategory extends RedMigrator
{
    public function dataHook($rows)
    {
        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            $row['parent_id'] = $row['parent'];
            $row['icon_id'] = $row['cat_emoticon'];
            $row['last_post_id'] = $row['id_last_msg'];
            $row['last_post_time'] = $row['time_last_msg'];

            // Remove unused fields.
            unset($row['parent']);
            unset($row['cat_emoticon']);
            unset($row['alert_admin']);
            unset($row['moderated']);
            unset($row['moderators']);
            unset($row['future2']);
            unset($row['id_last_msg']);
            unset($row['time_last_msg']);
        }

        return $rows;
    }
}