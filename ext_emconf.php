<?php

########################################################################
# Extension Manager/Repository config file for ext "jfimageflow".
#
# Auto generated 16-05-2011 23:28
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
	'dependencies' => 'cms,imagecarousel,jftcaforms',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => 'uploads/tx_jfimageflow',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '0.1.0',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'php' => '5.0.0-0.0.0',
			'typo3' => '4.3.0-0.0.0',
			'imagecarousel' => '1.6.4',
			'jftcaforms' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:34:{s:21:"ext_conf_template.txt";s:4:"ee56";s:12:"ext_icon.gif";s:4:"9fec";s:17:"ext_localconf.php";s:4:"3903";s:14:"ext_tables.php";s:4:"1113";s:13:"locallang.xml";s:4:"6c0c";s:16:"locallang_db.xml";s:4:"3696";s:12:"mode_dam.gif";s:4:"999b";s:15:"mode_damcat.gif";s:4:"2596";s:15:"mode_upload.gif";s:4:"fecd";s:14:"doc/manual.sxw";s:4:"c81d";s:42:"lib/class.tx_jfimageflow_itemsProcFunc.php";s:4:"dd6d";s:36:"lib/class.tx_jfimageflow_tceFunc.php";s:4:"d0a0";s:40:"lib/class.tx_jfimageflow_tsparserext.php";s:4:"20eb";s:14:"pi1/ce_wiz.gif";s:4:"6f21";s:32:"pi1/class.tx_jfimageflow_pi1.php";s:4:"3f91";s:40:"pi1/class.tx_jfimageflow_pi1_wizicon.php";s:4:"2577";s:13:"pi1/clear.gif";s:4:"cc11";s:19:"pi1/flexform_ds.xml";s:4:"613b";s:17:"pi1/locallang.xml";s:4:"420c";s:22:"res/imageflow-1.3.1.js";s:4:"8c24";s:27:"res/imageflow-1.3.1.pack.js";s:4:"6e31";s:16:"res/reflect2.php";s:4:"1bee";s:16:"res/reflect3.php";s:4:"31b1";s:13:"res/style.css";s:4:"5441";s:19:"res/style_black.css";s:4:"c118";s:21:"res/tx_jfimageflow.js";s:4:"f106";s:23:"res/img/button_left.png";s:4:"bda1";s:24:"res/img/button_pause.png";s:4:"32a3";s:23:"res/img/button_play.png";s:4:"4410";s:24:"res/img/button_right.png";s:4:"4410";s:18:"res/img/slider.png";s:4:"b48a";s:23:"res/img/slider_dark.png";s:4:"7b5d";s:20:"static/constants.txt";s:4:"799a";s:16:"static/setup.txt";s:4:"dfee";}',
	'suggests' => array(
	),
);

?>