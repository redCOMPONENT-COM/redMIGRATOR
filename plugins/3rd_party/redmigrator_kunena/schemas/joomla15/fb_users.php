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

class RedMigratorKunenaUser extends RedMigrator
{
    public function dataHook($rows)
    {
        $arrFields = array('userid',
                            'view',
                            'signature',
                            'moderator',
                            'ordering',
                            'posts',
                            'avatar',
                            'karma',
                            'karma_time',
                            'group_id',
                            'uhits',
                            'personalText',
                            'gender',
                            'birthdate',
                            'location',
                            'icq',
                            'aim',
                            'yim',
                            'msn',
                            'skype',
                            'gtalk',
                            'websitename',
                            'websiteurl',
                            'rank',
                            'hideEmail',
                            'showOnline'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

            // Change fields' name
            if (isset($row['ICQ']))
            {
                $row['icq'] = $row['ICQ'];
            }

            if (isset($row['AIM']))
            {
                $row['aim'] = $row['AIM'];
            }

            if (isset($row['YIM']))
            {
                $row['yim'] = $row['YIM'];
            }

            if (isset($row['MSN']))
            {
                $row['msn'] = $row['MSN'];
            }

            if (isset($row['SKYPE']))
            {
                $row['skype'] = $row['SKYPE'];
            }

            if ($row['GTALK'])
            {
                $row['gtalk'] = $row['GTALK'];
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