<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

// Define the TCA for the access control calendar selector.
$skinSelector = array(
	'skin_selector' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:templavoila_framework/locallang_db.php:skinSelectorLabel',
		'displayCond' => 'FIELD:root:REQ:true',
		'config' => array(
			'type' => 'user',
			'userFunc' => 'tx_templavoilaframework_skinselector->display',
		)
	),
);

// Add the skin selector for backend users.
t3lib_div::loadTCA('sys_template');
t3lib_extMgm::addTCAcolumns('sys_template', $skinSelector);
t3lib_extMgm::addToAllTCAtypes('sys_template', '--div--;LLL:EXT:templavoila_framework/locallang_db.php:skinSelectorTab, skin_selector');


/**
 * For TemplaVoila versions less than 1.5, add static data structures as part of TBE_MODULE_EXT
 * For TemplaVoila versions greater than or equal to 1.5, see ext_localconf.php
 */
if (tx_templavoilaframework_lib::getTemplaVoilaVersionAsInt() < 1005000) {
	$staticDataStructures = tx_templavoilaframework_lib::getStaticDataStructureArray(
		'EXT:' . $_EXTKEY . '/core_templates/datastructures/page/',
		'EXT:' . $_EXTKEY . '/core_templates/datastructures/fce/'
	);
	$GLOBALS['TBE_MODULES_EXT']['xMOD_tx_templavoila_cm1']['staticDataStructures'] = array_merge(
		(array) $GLOBALS['TBE_MODULES_EXT']['xMOD_tx_templavoila_cm1']['staticDataStructures'],
		$staticDataStructures
	);
}

// Only show the current FCE icon.
t3lib_div::loadTCA('tt_content');
$GLOBALS['TCA']['tt_content']['columns']['tx_templavoila_to']['config']['suppress_icons'] = 'ONLY_SELECTED';

?>
