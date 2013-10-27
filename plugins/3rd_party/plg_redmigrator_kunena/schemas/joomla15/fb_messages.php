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

class RedMigratorKunenaMessage extends RedMigrator
{
    public function dataHook($rows)
    {
        $arrFields = array('id',
                            'parent',
                            'thread',
                            'catid',
                            'name',
                            'userid',
                            'email',
                            'subject',
                            'time',
                            'ip',
                            'topic_emoticon',
                            'locked',
                            'hold',
                            'ordering',
                            'hits',
                            'moved',
                            'modified_by',
                            'modified_time',
                            'modified_reason'
                        );

        // Do some custom post processing on the list.
        foreach ($rows as &$row)
        {
            $row = (array) $row;

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