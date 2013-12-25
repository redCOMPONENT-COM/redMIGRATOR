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
/**
 * Upgrade class for Menus
 *
 * This class takes the menus from the existing site and inserts them into the new site.
 *
 * @since  0.4.5
 */

class RedMigratorMenu extends RedMigrator
{
	private $arrSystemComponents = array('com_banners',
											'com_banners_categories',
											'com_banners_clients',
											'com_banners_tracks',
											'com_contact',
											'com_contact_categories',
											'com_messages',
											'com_messages_add',
											'com_messages_read',
											'com_newsfeeds',
											'com_newsfeeds_feeds',
											'com_newsfeeds_categories',
											'com_redirect',
											'com_search',
											'com_weblinks',
											'com_weblinks_links',
											'com_weblinks_categories',
											'com_finder',
											'com_joomlaupdate');

	/**
	 * Sets the data in the destination database.
	 *
	 * @param   null  $rows  Rows
	 *
	 * @return null
	 */
	public function dataHook($rows = null)
	{
		$session = JFactory::getSession();

		$new_id = RedMigratorHelper::getAutoIncrement('menu') - 1;

		foreach ($rows as $k => &$row)
		{
			$row = (array) $row;

			// Not migrate system menus
			if (in_array($row['title'], $this->arrSystemComponents))
			{
				$rows[$k] = false;
			}
			else
			{
				// Create a map of old id and new id
				$old_id = (int) $row['id'];

				if ((int) $row['parent_id'] == 0)
				{
					$new_root_id = $this->getRootId();
					$arrTemp = array('old_id' => $old_id, 'new_id' => $new_root_id);
				}
				else
				{
					$new_id ++;
					$arrTemp = array('old_id' => $old_id, 'new_id' => $new_id);
				}

				$arrMenu = $session->get('arrMenu', null, 'redmigrator');

				$arrMenu[] = $arrTemp;

				// Save the map to session
				$session->set('arrMenu', $arrMenu, 'redmigrator');

				// Not migrate root menu
				if ((int) $row['parent_id'] == 0)
				{
					$rows[$k] = false;
				}
				else
				{
					// Parent item was inserted, so lookup new id
					if ((int) $row['id'] > (int) $row['parent_id'])
					{
						$row['parent_id'] = RedMigratorHelper::lookupNewId('arrMenu', (int) $row['parent_id']);
					}
					else // Parent item haven't been inserted, so will lookup new id and update item apter hook
					{
						$arrMenuSwapped = $session->get('arrMenuSwapped', null, 'redmigrator');

						$arrMenuSwapped[] = array('new_id' => $new_id, 'old_parent_id' => (int) $row['parent_id']);

						$session->set('arrMenuSwapped', $arrMenuSwapped, 'redmigrator');

						$row['parent_id'] = $this->getRootId();
					}

					$row['alias'] = $row['alias'] . '_old_' . $row['id'];
					$row['id'] = null;
					$row['lft'] = null;
					$row['rgt'] = null;

					$row['published'] = 0;

					// In J3x, column ordering has been removed
					if (version_compare(PHP_VERSION, '3.0', '>='))
					{
						unset($row['ordering']);
					}
				}
			}
		}

		return $rows;
	}

	/**
	 * Update items have patent item after itself
	 *
	 * @return bool
	 */
	public function afterHook()
	{
		$session = JFactory::getSession();

		$arrMenuSwapped = $session->get('arrMenuSwapped', null, 'redmigrator');

		foreach ($arrMenuSwapped as $item)
		{
			$objTable = JTable::getInstance('menu', 'JTable', array('dbo' => $this->_db));

			$objTable->load($item['new_id']);

			$objTable->parent_id = RedMigratorHelper::lookupNewId('arrMenu', $item['old_parent_id']);

			$objTable->setLocation($objTable->parent_id, 'last-child');

			if (!$objTable->store())
			{
				echo JError::raiseError(500, $objTable->getError());
			}
		}

		return parent::afterHook();
	}

	/**
	 * Insert data
	 *
	 * @param   array  $rows  Rows for target db
	 *
	 * @return bool|void
	 *
	 * @throws Exception
	 */
	protected function insertData($rows)
	{
		if (is_array($rows))
		{
			foreach ($rows as $row)
			{
				if ($row != false)
				{
					try
					{
						$objTable = JTable::getInstance('menu', 'JTable', array('dbo' => $this->_db));

						$objTable->setLocation($row['parent_id'], 'last-child');

						// Bind data to save category
						if (!$objTable->bind($row))
						{
							echo JError::raiseError(500, $objTable->getError());
						}

						if (!$objTable->store())
						{
							echo JError::raiseError(500, $objTable->getError());
						}
					}
					catch (Exception $e)
					{
						throw new Exception($e->getMessage());
					}
				}

				$this->_step->_nextCID();
			}
		}
		elseif (is_object($rows))
		{
			if ($rows != false)
			{
				try
				{
					$objTable = JTable::getInstance('menu', 'JTable', array('dbo' => $this->_db));

					$objTable->setLocation($rows->parent_id, 'last-child');

					// Bind data to save category
					if (!$objTable->bind($rows))
					{
						echo JError::raiseError(500, $objTable->getError());
					}

					if (!$objTable->store())
					{
						echo JError::raiseError(500, $objTable->getError());
					}
				}
				catch (Exception $e)
				{
					throw new Exception($e->getMessage());
				}
			}
		}

		return !empty($this->_step->error) ? false : true;
	}

	/**
	 * Get the id of root usergroup
	 *
	 * @return mixed
	 */
	protected function getRootId()
	{
		$query = $this->_db->getQuery(true);

		$query->select('id')
			->from('#__menu')
			->where('parent_id = 0');

		$this->_db->setQuery($query);

		$id = $this->_db->loadResult();

		return (int) $id;
	}
}
