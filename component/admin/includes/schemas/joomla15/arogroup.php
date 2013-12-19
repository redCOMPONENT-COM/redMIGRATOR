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
 * Upgrade class for Usergroups
 *
 * This class maps the old 1.5 usergroups to the new 1.6 system.
 *
 * @since  0.4.4
 */
class RedMigratorUsergroups extends RedMigrator
{
	/**
	 * Change structure of table and value of fields
	 * so data can be inserted into target db
	 *
	 * @param   array  $rows  Rows of source db
	 *
	 * @return mixed
	 */
	public function dataHook($rows)
	{
		$session = JFactory::getSession();

		$new_id = RedMigratorHelper::getAutoIncrement('usergroups') - 1;

		// Do some custom post processing on the list.
		foreach ($rows as $k => &$row)
		{
			$row = (array) $row;

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

			$arrUsergroups = $session->get('arrUsergroups', null, 'redmigrator_j25');

			$arrUsergroups[] = $arrTemp;

			// Save the map to session
			$session->set('arrUsergroups', $arrUsergroups, 'redmigrator_j25');

			if ((int) $row['parent_id'] == 0)
			{
				$rows[$k] = false;
			}
			else
			{
				// Parent item was inserted, so lookup new id
				if ((int) $row['id'] > (int) $row['parent_id'])
				{
					$row['parent_id'] = RedMigratorHelper::lookupNewId('arrUsergroups', (int) $row['parent_id']);
				}
				else // Parent item haven't been inserted, so will lookup new id and update item apter hook
				{
					$arrUsergroupsSwapped = $session->get('arrUsergroupsSwapped', null, 'redmigrator_j25');

					$arrUsergroupsSwapped[] = array('new_id' => $new_id, 'old_parent_id' => (int) $row['parent_id']);

					$session->set('arrUsergroupsSwapped', $arrUsergroupsSwapped, 'redmigrator_j25');

					$row['parent_id'] = $this->getRootId();
				}

				$row['id'] = null;
				$row['title'] = $row['name'] . '_old';
				$row['lft'] = null;
				$row['rgt'] = null;

				// Remove unused fields.
				unset($row['name']);
				unset($row['value']);
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

		$arrMenuSwapped = $session->get('arrUsergroupsSwapped', null, 'redmigrator_j25');

		foreach ($arrMenuSwapped as $item)
		{
			$objTable = JTable::getInstance('usergroup', 'JTable', array('dbo' => $this->_db));

			$objTable->load($item['new_id']);

			$objTable->parent_id = RedMigratorHelper::lookupNewId('arrUsergroups', $item['old_parent_id']);

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
						$objTable = JTable::getInstance('usergroup', 'JTable', array('dbo' => $this->_db));

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
					$objTable = JTable::getInstance('usergroup', 'JTable', array('dbo' => $this->_db));

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
			->from('#__usergroups')
			->where('parent_id = 0');

		$this->_db->setQuery($query);

		$id = $this->_db->loadResult();

		return (int) $id;
	}
}
