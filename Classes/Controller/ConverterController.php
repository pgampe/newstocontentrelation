<?php
namespace Tx\Newstocontentrelation\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Philipp Gampe <philipp.gampe@typo3.org>
 *  All rights reserved
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
	public function indexAction($current, $next) {
		$this->view->assign('current', (integer)$current);
		$this->view->assign('next', (integer)$next);
	}

	/**
	 * Convert the records
	 *
	 * @param integer $start
	 * @param integer $count
	 */
	protected function convertAction($start = 0, $count = 10) {

	}

	/**
	 * Does the actual conversion
	 *
	 * @param integer $current The current position
	 * @param integer $count The amount of records to convert
	 * @return mixed
	 */
	protected function process($current, $count) {

		return $current;
	}

} 