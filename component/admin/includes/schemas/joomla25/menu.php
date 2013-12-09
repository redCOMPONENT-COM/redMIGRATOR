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
	/**
	 * Sets the data in the destination database.
	 *
	 * @param null $rows
	 *
	 * @return null
	 */
	public function dataHook($rows = null)
	{
		$session = JFactory::getSession();

		$new_id = RedMigratorHelper::getAutoIncrement('menu') - 1;

		foreach ($rows as &$row)
		{
			$row = (array) $row;

			// Create a map of old id and new id
			$old_id = (int) $row['id'];

			$new_root_id = 1;

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

			$arrMenu = $session->get('arrMenu', null, 'redmigrator_j25');

			$arrMenu[] = $arrTemp;

			// Save the map to session
			$session->set('arrMenu', $arrMenu, 'redmigrator_j25');

			if ((int) $row['parent_id'] != 0)
			{
				// Parent item was inserted, so lookup new id
				if ((int) $row['id'] > (int) $row['parent_id'])
				{
					$row['parent_id'] = RedMigratorHelper::lookupNewId('arrMenu', (int) $row['parent_id']);
				}
				else // Parent item haven't been inserted, so will lookup new id and update item apter hook
				{
					$arrMenuSwapped = $session->get('arrMenuSwapped', null, 'redmigrator_j25');

					$arrMenuSwapped[] = array('new_id' => $new_id, 'old_parent_id' => (int) $row['parent_id']);

					$session->set('arrMenuSwapped', $arrMenuSwapped, 'redmigrator_j25');

					$row['parent_id'] = $new_root_id;
				}

				$row['menutype'] = $row['menutype'] . '_old';
				$row['alias'] = $row['alias'] . '_old_' . $row['id'];
				$row['id'] = null;
				$row['lft'] = null;
				$row['rgt'] = null;
			}

			// In J3x, column ordering has been removed
			if (version_compare(PHP_VERSION, '3.0', '>='))
			{
				unset($row['ordering']);
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

		$arrMenuSwapped = $session->get('arrMenuSwapped', null, 'redmigrator_j25');

		foreach ($arrMenuSwapped as $item)
		{
			$objTable = JTable::getInstance('menu', 'JTable', array('dbo' => $this->_db));

			$objTable->load($item['new_id']);

			$objTable->parent_id = RedMigratorHelper::lookupNewId('arrMenu', $item['old_parent_id']);

			$objTable->setLocation($objTable->parent_id, 'last-child');

			if (!@$objTable->store())
			{
				echo JError::raiseError(500, $objTable->getError());
			}
		}

		return parent::afterHook();
	}

	/**
	 * @param $rows Rows for target db
	 *
	 * @return bool|void
	 * @throws Exception
	 */
	protected function insertData($rows)
	{
		if (is_array($rows))
		{
			$total = count($rows);

			foreach ($rows as $row)
			{
				if ($row != false && (int) $row['parent_id'] != 0)
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

						if (!@$objTable->store())
						{
							echo JError::raiseError(500, $objTable->getError());
						}
					}
					catch (Exception $e)
					{
						throw new Exception($e->getMessage());
					}
				}

				$this->_step->_nextCID($total);
			}
		}
		elseif (is_object($rows))
		{
			if ($rows != false && $rows->parent_id != 0)
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

					if (!@$objTable->store())
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
