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

            if ($row['parent'] == 0)
            {
                $this->insertIntoTopic($row);
            }
        }

        return $rows;
    }

    public function insertIntoTopic($row)
    {
        $query = $this->_db->getQuery(true);

        $query->clear();

        $query->insert('#__kunena_topics')
                ->set('category_id = ' . $row['catid'])
                ->set('subject = "' . $row['subject'] . '"')
                ->set('locked = ' . $row['locked'])
                ->set('hold = ' . $row['hold'])
                ->set('ordering = ' . $row['ordering'])
                ->set('hits = ' . $row['hits'])
                ->set('moved_id = ' . $row['moved'])
                ->set('first_post_id = ' . $row['id'])
                ->set('first_post_time = ' . $row['time'])
                ->set('first_post_userid = ' . $row['userid'])
                ->set('last_post_id = ' . $row['id'])
                ->set('last_post_time = ' . $row['time'])
                ->set('last_post_userid = ' . $row['userid']);

        $this->_db->setQuery($query);

        $this->_db->query();
    }
}
?>