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
 * Upgrade class for categories
 *
 * This class takes the categories from the existing site and inserts them into the new site.
 *
 * @since  0.4.5
 */
class RedMigratorCategories extends RedMigrator
{
	/**
	 * Change structure of table and value of fields
	 * so data can be inserted into target db
	 *
	 * @param $rows Rows of source db
	 *
	 * @return mixed
	 */
	public function dataHook($rows)
	{
		$session = JFactory::getSession();

		$new_id = RedMigratorHelper::getAutoIncrement('categories') - 1;

		// Do some custom post processing on the list.
		foreach ($rows as &$row)
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

			$arrCategories = $session->get('arrCategories', null, 'redmigrator_j25');

			$arrCategories[] = $arrTemp;

			// Save the map to session
			$session->set('arrCategories', $arrCategories, 'redmigrator_j25');

			if ((int) $row['parent_id'] != 0)
			{
				$row['id'] = null;
				$row['alias'] = $row['alias'] . '_old';
				$row['parent_id'] = RedMigratorHelper::lookupNewId('arrCategories', (int) $row['parent_id']);
				$row['lft'] = null;
				$row['rgt'] = null;
			}
		}

		return $rows;
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
						$objTable = JTable::getInstance('category', 'JTable', array('dbo' => $this->_db));
						$objTable->setLocation((int) $row['parent_id'], 'last-child');

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
					$objTable = JTable::getInstance('category', 'JTable', array('dbo' => $this->_db));
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
	 * Get the id of root category
	 *
	 * @return mixed
	 */
	protected function getRootId()
	{
		$query = $this->_db->getQuery(true);

		$query->select('id')
			->from('#__categories')
			->where('parent_id = 0');

		$this->_db->setQuery($query);

		$id = $this->_db->loadResult();

		return (int) $id;
	}
}
