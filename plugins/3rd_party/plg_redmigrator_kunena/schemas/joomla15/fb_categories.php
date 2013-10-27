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
        $arrFields = array('id',
                            'parent_id',
                            'name',
                            'icon_id',
                            'locked',
                            'pub_access',
                            'pub_recurse',
                            'admin_access',
                            'admin_recurse',
                            'ordering',
                            'published',
                            'checked_out',
                            'checked_out_time',
                            'review',
                            'hits',
                            'description',
                            'headerdesc',
                            'class_sfx',
                            'numTopics',
                            'numPosts',
                            'last_post_id',
                            'last_post_time'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['parent']))
            {
                $row['parent_id'] = $row['parent'];
            }

            if (isset($row['name']) && isset($row['id']))
            {
                $row['alias'] = JApplication::stringURLSafe($row['name'] . '-' . $row['id']);
            }

            if (isset($row['cat_emoticon']))
            {
                $row['icon_id'] = $row['cat_emoticon'];
            }

            if (isset($row['id_last_msg']))
            {
                $row['last_post_id'] = $row['id_last_msg'];
            }

            if (isset($row['time_last_msg']))
            {
                $row['last_post_time'] = $row['time_last_msg'];
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