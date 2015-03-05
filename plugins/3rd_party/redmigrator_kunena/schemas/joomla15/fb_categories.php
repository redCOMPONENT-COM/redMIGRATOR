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

class RedMigratorKunenaCategory extends RedMigrator
{
    public function dataHook($rows)
    {
        $arrFields = array('id',
                            'parent_id',
                            'name',
                            'alias',
                            'icon_id',
                            'locked',
                            'access',
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
                            'last_topic_id',
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

            if (isset($row['name']))
            {
                $row['alias'] = JApplication::stringURLSafe($row['name']);
            }

            $row['access'] = 1;

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

            if (isset($row['numTopics']) && isset($row['numPosts']))
            {
                $row['numPosts'] = $row['numTopics'] + $row['numPosts'];
            }

            $row['last_topic_id'] = $this->getLastTopicId($row['id']);

            foreach ($row as $key => $value)
            {
                if (!in_array($key, $arrFields))
                {
                    unset($row[$key]);
                }
            }

            $this->insertIntoAlias($row);
        }        

        return $rows;
    }

    public function insertIntoAlias($row)
    {
        $query = $this->_db->getQuery(true);

        $query->clear();

        $query->insert('#__kunena_aliases')
                ->set('alias = "' . $row['alias'] . '"')
                ->set('type = "catid"')
                ->set('item = ' . $row['id'])
                ->set('state = 1');

        $this->_db->setQuery($query);

        $this->_db->query();
    }

    public function getLastTopicId($catId)
    {
        $query = $this->_db->getQuery(true);

        $query->clear();

        $query->select('id, first_post_time')
                ->from('#__kunena_topics')
                ->where('category_id = ' . $catId)
                ->order('first_post_time DESC');

        $this->_db->setQuery($query);

        $arrId = $this->_db->loadAssoc();

        if ($arrId)
        {
           return $arrId['id'];
        }

        return 0;
    }
}