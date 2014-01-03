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
 * Migrate class for content
 *
 * This class takes the content from the existing site and inserts them into the new site.
 */
class RedMigratorContent extends RedMigrator
{
	/**
	 * Sets the data in the destination database.
	 *
	 * @return	void
	 */
	public function dataHook($rows)
	{
		$session = JFactory::getSession();

		$new_id = RedMigratorHelper::getAutoIncrement('content') - 1;

		foreach ($rows as &$row)
		{
			$row = (array) $row;

			// Create a map of old id and new id
			$old_id = (int) $row['id'];
			$new_id ++;
			$arrTemp = array('old_id' => $old_id, 'new_id' => $new_id);

			$arrContent = $session->get('arrContent', null, 'redmigrator');

			$arrContent[] = $arrTemp;

			// Save the map to session
			$session->set('arrContent', $arrContent, 'redmigrator');

			$row['id'] = null;

			if ($row['catid'] != '')
			{
				$row['catid'] = RedMigratorHelper::lookupNewId('arrCategories', (int) $row['catid']);
			}

			if ($row['created_by'] != '')
			{
				$row['created_by'] = RedMigratorHelper::lookupNewId('arrUsers', (int) $row['created_by']);
			}

			if ($row['modified_by'] != '')
			{
				$row['modified_by'] = RedMigratorHelper::lookupNewId('arrUsers', (int) $row['modified_by']);
			}

			$row['attribs'] = $this->convertParams($row['attribs']);
			$row['access'] = $row['access'] == 0 ? 1 : $row['access'] + 1;
			$row['language'] = '*';

			// Correct state
			if ($row['state'] == -1)
			{
				$row['state'] = 2;
			}

			// Prevent JGLOBAL_ARTICLE_MUST_HAVE_TEXT error
			if (trim($row['introtext']) == '' && trim($row['fulltext']) == '')
			{
				$row['introtext'] = '&nbsp;';
			}

			if (version_compare(PHP_VERSION, '3.0', '>='))
			{
				unset($row['title_alias']);
				unset($row['sectionid']);
				unset($row['mask']);
				unset($row['parentid']);
			}
		}

		return $rows;
	}

	/**
	 * A hook to be able to modify params prior as they are converted to JSON.
	 *
	 * @param   object  &$object  Object
	 */
	protected function convertParamsHook(&$object)
	{
		$object->show_parent_category = isset($object->show_parent_category) ? $object->show_parent_category : "";
		$object->link_parent_category = isset($object->link_parent_category) ? $object->link_parent_category : "";
		$object->show_author = isset($object->show_author) ? $object->show_author : "";
		$object->link_author = isset($object->link_author) ? $object->link_author : "";
		$object->show_publish_date = isset($object->show_publish_date) ? $object->show_publish_date : "";
		$object->show_item_navigation = isset($object->show_item_navigation) ? $object->show_item_navigation : "";
		$object->show_print_icons = isset($object->show_print_icons) ? $object->show_print_icons : "";
		$object->show_icons = isset($object->show_icons) ? $object->show_icons : "";
		$object->show_vote = isset($object->show_vote) ? $object->show_vote : "";
		$object->show_hits = isset($object->show_hits) ? $object->show_hits : "";
		$object->show_noauth = isset($object->show_noauth) ? $object->show_noauth : "";
		$object->alternative_readmore = isset($object->alternative_readmore) ? $object->alternative_readmore : "";
		$object->article_layout = isset($object->article_layout) ? $object->article_layout : "";
		$object->show_publishing_options = isset($object->show_publishing_options) ? $object->show_publishing_options : "";
		$object->show_article_options = isset($object->show_article_options) ? $object->show_article_options : "";
		$object->show_urls_images_backend = isset($object->show_urls_images_backend) ? $object->show_urls_images_backend : "";
		$object->show_urls_images_frontend = isset($object->show_urls_images_frontend) ? $object->show_urls_images_frontend : "";

		// Component params
		$object->list_show_hits = isset($object->show_hits) ? $object->show_hits : "";
		$object->list_show_author = isset($object->show_author) ? $object->show_author : "";
		$object->show_readmore = isset($object->show_readmore) ? $object->show_readmore : "";

		unset($object->show_section);
		unset($object->link_section);
		unset($object->show_vote);
		unset($object->show_pdf_icon);
		unset($object->language);
		unset($object->keyref);
		unset($object->readmore);
		unset($object->urls_position);
		unset($object->feed_show_readmore);
	}
}
