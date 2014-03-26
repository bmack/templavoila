<?php

/***************************************************************
 * Copyright notice
 *
 * (c) 2010 Tolleiv Nietsch (tolleiv.nietsch@typo3.org)
 * (c) 2010 Steffen Kamper (info@sk-typo3.de)
 *  All rights reserved
 *
 *  This script is part of the Typo3 project. The Typo3 project is
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
class tx_templavoila_preview_type_textpic extends tx_templavoila_preview_type_text {

	protected $previewField = 'bodytext';

	/**
	 * (non-PHPdoc)
	 *
	 * @see classes/preview/tx_templavoila_preview_type_text#render_previewContent($row, $table, $output, $alreadyRendered, $ref)
	 */
	public function render_previewContent($row, $table, $output, $alreadyRendered, &$ref) {

		$this->parentObj = $ref;

		$uploadDir = $GLOBALS['TCA']['tt_content']['columns']['image']['config']['internal_type'] == 'file_reference' ? '' : NULL;

		$thumbnail = '<strong>' . $GLOBALS['LANG']->sL(\TYPO3\CMS\Backend\Utility\BackendUtility::getItemLabel('tt_content', 'image'), 1) . '</strong><br />';
		$thumbnail .= \TYPO3\CMS\Backend\Utility\BackendUtility::thumbCode($row, 'tt_content', 'image', $ref->doc->backPath, '', $uploadDir);

		$label = $this->getPreviewLabel();
		$data = $this->getPreviewData($row);

		if ($ref->currentElementBelongsToCurrentPage) {
			$text = $ref->link_edit('<strong>' . $label . '</strong> ' . $data, 'tt_content', $row['uid']);
		} else {
			$text = '<strong>' . $label . '</strong> ' . $data;
		}

		return '
		<table>
			<tr>
				<td valign="top">' . $text . '</td>
				<td valign="top">' . $thumbnail . '</td>
			</tr>
		</table>';
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/templavoila/classes/preview/class.tx_templavoila_preview_type_textpic.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/templavoila/classes/preview/class.tx_templavoila_preview_type_textpic.php']);
}
