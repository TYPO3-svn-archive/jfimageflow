<?php

########################################################################
# Extension Manager/Repository config file for ext "jfimageflow".
#
# Auto generated 18-04-2011 22:24
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'ImageFlow',
	'description' => 'Show images as an ImageFlow, manage the images, captions and hrefs in backend.',
	'category' => 'plugin',
	'author' => 'Juergen Furrer',
	'author_email' => 'juergen.furrer@gmail.com',
	'shy' => '',
	'dependencies' => 'imagecarousel,jftcaforms',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => 'uploads/tx_jfimageflow',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '0.0.0',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'php' => '5.0.0',
			'typo3' => '4.3.0',
			'imagecarousel' => '1.6.3',
			'jftcaforms' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:16:{s:9:"ChangeLog";s:4:"af17";s:10:"README.txt";s:4:"ee2d";s:12:"ext_icon.gif";s:4:"1bdc";s:17:"ext_localconf.php";s:4:"ae6a";s:14:"ext_tables.php";s:4:"8300";s:13:"locallang.xml";s:4:"56cc";s:16:"locallang_db.xml";s:4:"8817";s:19:"doc/wizard_form.dat";s:4:"19f9";s:20:"doc/wizard_form.html";s:4:"b14a";s:14:"pi1/ce_wiz.gif";s:4:"02b6";s:32:"pi1/class.tx_jfimageflow_pi1.php";s:4:"1d09";s:40:"pi1/class.tx_jfimageflow_pi1_wizicon.php";s:4:"5143";s:13:"pi1/clear.gif";s:4:"cc11";s:17:"pi1/locallang.xml";s:4:"420c";s:30:"static/imageflow/constants.txt";s:4:"9273";s:26:"static/imageflow/setup.txt";s:4:"0891";}',
);

?>