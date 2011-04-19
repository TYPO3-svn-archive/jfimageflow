<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Juergen Furrer <juergen.furrer@gmail.com>
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
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */

require_once(t3lib_extMgm::extPath('imagecarousel').'pi1/class.tx_imagecarousel_pi1.php');

/**
 * Plugin 'ImageFlow' for the 'jfimageflow' extension.
 *
 * @author	Juergen Furrer <juergen.furrer@gmail.com>
 * @package	TYPO3
 * @subpackage	tx_jfimageflow
 */
class tx_jfimageflow_pi1 extends tx_imagecarousel_pi1
{
	public $prefixId      = 'tx_jfimageflow_pi1';
	public $scriptRelPath = 'pi1/class.tx_jfimageflow_pi1.php';
	public $extKey        = 'jfimageflow';
	public $pi_checkCHash = true;
	public $lConf = array();
	public $templatePart = null;
	public $contentKey = null;
	public $jsFiles = array();
	public $js = array();
	public $cssFiles = array();
	public $css = array();
	public $images = array();
	public $hrefs = array();
	public $captions = array();
	public $description = array();
	public $imageDir = 'uploads/tx_jfimageflow/';
	public $type = 'normal';

	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	public function main($content, $conf)
	{
		$this->conf = $conf;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();
			// define the key of the element
		$this->setContentKey();

		$pageID = false;
		if ($this->cObj->data['list_type'] == $this->extKey.'_pi1') {
			$this->type = 'normal';
			// It's a content, al data from flexform
			// Set the Flexform information
			$this->pi_initPIflexForm();
			$piFlexForm = $this->cObj->data['pi_flexform'];
			foreach ($piFlexForm['data'] as $sheet => $data) {
				foreach ($data as $lang => $value) {
					foreach ($value as $key => $val) {
						$this->lConf[$key] = $this->pi_getFFvalue($piFlexForm, $key, $sheet);
					}
				}
			}
			// define the key of the element
			$this->setContentKey($this->extKey . "_c" . $this->cObj->data['uid']);

			// define the images
			switch ($this->lConf['mode']) {
				case "" : {}
				case "folder" : {}
				case "upload" : {
					$this->setDataUpload();
					break;
				}
				case "dam" : {
					$this->setDataDam(false);
					break;
				}
				case "dam_catedit" : {
					$this->setDataDam(true);
					break;
				}
			}

			// overwrite the config
			if ($this->lConf['imagewidth']) {
				$this->conf['imagewidth'] = $this->lConf['imagewidth'];
			}
			if ($this->lConf['imageheight']) {
				$this->conf['imageheight'] = $this->lConf['imageheight'];
			}
			if ($this->lConf['animationSpeed']) {
				$this->conf['animationSpeed'] = $this->lConf['animationSpeed'];
			}

			if ($this->lConf['animationSpeed']) {
				$this->conf['animationSpeed'] = $this->lConf['animationSpeed'];
			}
			if ($this->lConf['aspectRatio']) {
				$this->conf['aspectRatio'] = $this->lConf['aspectRatio'];
			}
			if ($this->lConf['buttons'] < 2) {
				$this->conf['buttons'] = $this->lConf['buttons'];
			}
			if ($this->lConf['captions'] < 2) {
				$this->conf['captions'] = $this->lConf['captions'];
			}
			if ($this->lConf['circular'] < 2) {
				$this->conf['circular'] = $this->lConf['circular'];
			}

			if ($this->lConf['imageCursor']) {
				$this->conf['imageCursor'] = $this->lConf['imageCursor'];
			}
			if ($this->lConf['ImageFlowID']) {
				$this->conf['ImageFlowID'] = $this->lConf['ImageFlowID'];
			}
			if ($this->lConf['imageFocusM']) {
				$this->conf['imageFocusM'] = $this->lConf['imageFocusM'];
			}
			if ($this->lConf['imageFocusMax']) {
				$this->conf['imageFocusMax'] = $this->lConf['imageFocusMax'];
			}
			if ($this->lConf['imageScaling'] < 2) {
				$this->conf['imageScaling'] = $this->lConf['imageScaling'];
			}
			if ($this->lConf['imagesHeight']) {
				$this->conf['imagesHeight'] = $this->lConf['imagesHeight'];
			}
			if ($this->lConf['imagesM']) {
				$this->conf['imagesM'] = $this->lConf['imagesM'];
			}
			if ($this->lConf['opacity'] < 2) {
				$this->conf['opacity'] = $this->lConf['opacity'];
			}

			if ($this->lConf['percentLandscape']) {
				$this->conf['percentLandscape'] = $this->lConf['percentLandscape'];
			}
			if ($this->lConf['percentOther']) {
				$this->conf['percentOther'] = $this->lConf['percentOther'];
			}

			if ($this->lConf['preloadImages'] < 2) {
				$this->conf['preloadImages'] = $this->lConf['preloadImages'];
			}

			if ($this->lConf['reflections'] < 2) {
				$this->conf['reflections'] = $this->lConf['reflections'];
			}
			if ($this->lConf['reflectionGET']) {
				$this->conf['reflectionGET'] = $this->lConf['reflectionGET'];
			}
			if ($this->lConf['reflectionP']) {
				$this->conf['reflectionP'] = $this->lConf['reflectionP'];
			}
			if ($this->lConf['reflectionPNG'] < 2) {
				$this->conf['reflectionPNG'] = $this->lConf['reflectionPNG'];
			}
			if ($this->lConf['backgroundColor']) {
				$this->conf['backgroundColor'] = $this->lConf['backgroundColor'];
			}

			if ($this->lConf['scrollbarP']) {
				$this->conf['scrollbarP'] = $this->lConf['scrollbarP'];
			}
			if ($this->lConf['slider'] < 2) {
				$this->conf['slider'] = $this->lConf['slider'];
			}
			if ($this->lConf['sliderCursor']) {
				$this->conf['sliderCursor'] = $this->lConf['sliderCursor'];
			}
			if ($this->lConf['sliderWidth']) {
				$this->conf['sliderWidth'] = $this->lConf['sliderWidth'];
			}
			if ($this->lConf['slideshow'] < 2) {
				$this->conf['slideshow'] = $this->lConf['slideshow'];
			}
			if ($this->lConf['slideshowSpeed']) {
				$this->conf['slideshowSpeed'] = $this->lConf['slideshowSpeed'];
			}
			if ($this->lConf['slideshowAutoplay'] < 2) {
				$this->conf['slideshowAutoplay'] = $this->lConf['slideshowAutoplay'];
			}

			if ($this->lConf['startID']) {
				$this->conf['startID'] = $this->lConf['startID'];
			}
			if ($this->lConf['glideToStartID']) {
				$this->conf['glideToStartID'] = $this->lConf['glideToStartID'];
			}
			if ($this->lConf['startAnimation']) {
				$this->conf['startAnimation'] = $this->lConf['startAnimation'];
			}
			if ($this->lConf['xStep']) {
				$this->conf['xStep'] = $this->lConf['xStep'];
			}

			return $this->parseTemplate();
		}
	}

	/**
	 * Parse all images into the template
	 * @param $data
	 * @return string
	 */
	public function parseTemplate($dir='', $onlyJS=false)
	{
		// define the directory of images
		if ($dir == '') {
			$dir = $this->imageDir;
		}

		// define the contentKey if not exist
		if ($this->getContentKey() == '') {
			$this->setContentKey($this->extKey . '_key');
		}

		// define the js files
		$this->addJsFile($this->conf['imageFlowJS']);
		$this->addCssFile($this->conf['imageFlowCSS']);

		// get the options from config
		$options = array();
		$options['ImageFlowID'] = "ImageFlowID: '{$this->getContentKey()}'";
		$options['imagePath'] = "imagePath: '{$this->conf['imagePath']}'";
		$options['reflectPath'] = "reflectPath: '{$this->conf['reflectPath']}'";

		if (is_numeric($this->conf['animationSpeed'])) {
			$options['animationSpeed'] = "animationSpeed: {$this->conf['animationSpeed']}";
		}
		if ($this->conf['aspectRatio'] > 0) {
			$options['aspectRatio'] = "aspectRatio: {$this->conf['aspectRatio']}";
		}
		$options['buttons']  = "buttons: ".($this->conf['buttons'] ? 'true' : 'false');
		$options['captions'] = "captions: ".($this->conf['captions'] ? 'true' : 'false');
		$options['circular'] = "circular: ".($this->conf['circular'] ? 'true' : 'false');

		if ($this->conf['reflectionGET'] . $this->conf['backgroundColor']) {
			$get = array();
			if ($this->conf['reflectionGET']) {
				$get[] = $this->conf['reflectionGET'];
			}
			if ($this->conf['backgroundColor']) {
				$get[] = "bgc=".$this->conf['backgroundColor'];
			}
			$options['reflectionGET'] = "reflectionGET: '&".implode("&", $get)."'";
		}
/*

$this->conf['imageCursor']
$this->conf['ImageFlowID']
$this->conf['imageFocusM']
$this->conf['imageFocusMax']
$this->conf['imageScaling']
$this->conf['imagesHeight']
$this->conf['imagesM']
$this->conf['opacity']

$this->conf['percentLandscape']
$this->conf['percentOther']

$this->conf['preloadImages']

$this->conf['reflections']
$this->conf['reflectionGET']
$this->conf['reflectionP']
$this->conf['reflectionPNG']

$this->conf['scrollbarP']
$this->conf['slider']
$this->conf['sliderCursor']
$this->conf['sliderWidth']
$this->conf['slideshow']
$this->conf['slideshowSpeed']
$this->conf['slideshowAutoplay']

$this->conf['startID']
$this->conf['glideToStartID']
$this->conf['startAnimation']
$this->conf['xStep']
*/
		$this->addJS("
domReady(function() {
	var {$this->getContentKey()} = new ImageFlow();
	{$this->getContentKey()}.init(".(count($options) ? "{\n		".implode(",\n		", $options)."\n	}" : "").");
});
");

		// Add the ressources
		$this->addResources();

		if ($onlyJS === true) {
			return true;
		}

		$return_string = null;
		$images = null;
		$navigation = null;
		$markerArray = array();
		$GLOBALS['TSFE']->register['key'] = $this->getContentKey();
		$GLOBALS['TSFE']->register['class'] = $skin_class;
		$GLOBALS['TSFE']->register['imagewidth']  = $this->conf['imagewidth'];
		$GLOBALS['TSFE']->register['imageheight'] = $this->conf['imageheight'];
		$GLOBALS['TSFE']->register['IMAGE_NUM_CURRENT'] = 0;
		if (count($this->images) > 0) {
			foreach ($this->images as $key => $image_name) {
				$image = null;
				$imgConf = $this->conf['imageflow.'][$this->type.'.']['image.'];
				$totalImagePath = $this->imageDir . $image_name;
				$GLOBALS['TSFE']->register['file']        = $totalImagePath;
				$GLOBALS['TSFE']->register['href']        = $this->hrefs[$key];
				$GLOBALS['TSFE']->register['caption']     = $this->captions[$key];
				$GLOBALS['TSFE']->register['description'] = $this->description[$key];
				$GLOBALS['TSFE']->register['CURRENT_ID']  = $GLOBALS['TSFE']->register['IMAGE_NUM_CURRENT'] + 1;
				if ($this->hrefs[$key]) {
					$imgConf['imageLinkWrap.'] = $imgConf['imageHrefWrap.'];
				}
				$image = $this->cObj->IMAGE($imgConf);
				$images .= $this->cObj->typolink($image, $imgConf['imageLinkWrap.']);
				// create the navigation
				$GLOBALS['TSFE']->register['IMAGE_NUM_CURRENT'] ++;
			}
			// the stdWrap
			$images = $this->cObj->stdWrap($images, $this->conf['imageflow.'][$this->type.'.']['stdWrap.']);
			$return_string = $this->cObj->substituteMarkerArray($images, $markerArray, '###|###', 0);
		}
		return $this->pi_wrapInBaseClass($return_string);
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jfimageflow/pi1/class.tx_jfimageflow_pi1.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jfimageflow/pi1/class.tx_jfimageflow_pi1.php']);
}
?>