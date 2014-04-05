<?php
namespace Tx\Newstocontentrelation\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Philipp Gampe <philipp.gampe@typo3.org>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Class ConverterController
 * @package Tx\newstocontentrelation\Controller
 */
class ConverterController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * @var \Tx_News_Domain_Repository_NewsRepository
	 * @inject
	 */
	protected $newsRepository = NULL;

	/**
	 * Shows the backend module
	 *
	 * @param integer $current The current position
	 * @param integer $next The amount of news entries to process
	 * @return void
	 */
	public function indexAction($current = 0, $next = 10) {
		$this->view->assign('current', (integer)$current);
		$this->view->assign('next', (integer)$next);
	}

	/**
	 * Convert the next round of records
	 *
	 * @param integer $current The current position
	 * @param integer $next The amount of records to convert
	 * @return void
	 */
	protected function convertAction($current = 0, $next = 10) {
		$last = FALSE;
		$count = $this->getDatabaseConnection()->exec_SELECTcountRows('uid', 'tx_news_domain_model_news');
		$end = $current + $next;
		if ($end > $count) {
			$end = $count;
			$last = TRUE;
		}
		$this->process($current, $end);
		if (!$last) {
			$this->redirect('index', NULL, NULL, array('current' => $end + 1, 'next' => $next));
		}
		$this->view->assign('total', $end);
	}

	/**
	 * Does the actual conversion
	 *
	 * @param integer $current The current position
	 * @param integer $end The position of the last converted record
	 * @return void
	 */
	protected function process($current, $end) {
		for ($recordUid = $current; $recordUid <= $end; $recordUid++) {
			/** @var \tx_news_domain_model_news $news */
			$news = $this->newsRepository->findByUid($recordUid);
			if ($news === NULL) {
				continue;
			}
			$text = trim($news->getBodytext());
			if ($text !== '') {
				$news->setBodytext('');
				/** @var \Tx_News_Domain_Model_TtContent $content */
				$content = $this->objectManager->get('Tx_News_Domain_Model_TtContent');
				$content->setBodytext($text);
				$content->setCType('text');
				$content->setPid($news->getPid());
				$content->setHeaderLayout(100);
				$news->addContentElement($content);
				$this->newsRepository->update($news);
			}
		}
	}

	/**
	 * Gets the database connection
	 *
	 * @return \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected function getDatabaseConnection() {
		return $GLOBALS['TYPO3_DB'];
	}
} 