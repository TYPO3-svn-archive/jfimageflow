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
	public $images = array();
	public $hrefs = array();
	public $captions = array();
	public $description = array();
	public $imageDir = 'uploads/tx_jfimageflow/';
	public $type = 'normal';
	public $lConf = array();
	public $templatePart = null;
	public $contentKey = null;
	public $jsFiles = array();
	public $js = array();
	public $cssFiles = array();
	public $css = array();
	public $templateFileJS = null;

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
			$this->lConf['mode']              = $this->getFlexformData('general', 'mode');
			$this->lConf['images']            = $this->getFlexformData('general', 'images', ($this->lConf['mode'] == 'upload'));
			$this->lConf['hrefs']             = $this->getFlexformData('general', 'hrefs', ($this->lConf['mode'] == 'upload'));
			$this->lConf['captions']          = $this->getFlexformData('general', 'captions', ($this->lConf['mode'] == 'upload'));
			$this->lConf['descriptions']      = $this->getFlexformData('general', 'descriptions', ($this->lConf['mode'] == 'upload'));
			$this->lConf['damimages']         = $this->getFlexformData('general', 'damimages', ($this->lConf['mode'] == 'dam'));
			$this->lConf['damcategories']     = $this->getFlexformData('general', 'damcategories', ($this->lConf['mode'] == 'dam_catedit'));

			$this->lConf['imagewidth']        = $this->getFlexformData('image', 'imagewidth');
			$this->lConf['imageheight']       = $this->getFlexformData('image', 'imageheight');
			$this->lConf['imageFocusMax']     = $this->getFlexformData('image', 'imageFocusMax');
			$this->lConf['percentLandscape']  = $this->getFlexformData('image', 'percentLandscape');
			$this->lConf['percentOther']      = $this->getFlexformData('image', 'percentOther');
			$this->lConf['imageCursor']       = $this->getFlexformData('image', 'imageCursor');
			$this->lConf['imageScaling']      = $this->getFlexformData('image', 'imageScaling');
			$this->lConf['opacity']           = $this->getFlexformData('image', 'opacity');
			$this->lConf['preloadImages']     = $this->getFlexformData('image', 'preloadImages');
			$this->lConf['imageFocusM']       = $this->getFlexformData('image', 'imageFocusM');
			$this->lConf['imagesHeight']      = $this->getFlexformData('image', 'imagesHeight');
			$this->lConf['imagesM']           = $this->getFlexformData('image', 'imagesM');

			$this->lConf['animationSpeed']    = $this->getFlexformData('movement', 'animationSpeed');
			$this->lConf['slideshowSpeed']    = $this->getFlexformData('movement', 'slideshowSpeed');
			$this->lConf['captionsToggle']    = $this->getFlexformData('movement', 'captionsToggle');
			$this->lConf['circular']          = $this->getFlexformData('movement', 'circular');
			$this->lConf['slideshowAutoplay'] = $this->getFlexformData('movement', 'slideshowAutoplay');
			$this->lConf['aspectRatio']       = $this->getFlexformData('movement', 'aspectRatio');

			$this->lConf['sliderWidth']       = $this->getFlexformData('control', 'sliderWidth');
			$this->lConf['sliderCursor']      = $this->getFlexformData('control', 'sliderCursor');
			$this->lConf['buttons']           = $this->getFlexformData('control', 'buttons');
			$this->lConf['slider']            = $this->getFlexformData('control', 'slider');
			$this->lConf['slideshow']         = $this->getFlexformData('control', 'slideshow');
			$this->lConf['scrollbarP']        = $this->getFlexformData('control', 'scrollbarP');

			$this->lConf['reflectionGET']     = $this->getFlexformData('reflection', 'reflectionGET');
			$this->lConf['backgroundColor']   = $this->getFlexformData('reflection', 'backgroundColor');
			$this->lConf['reflections']       = $this->getFlexformData('reflection', 'reflections');
			$this->lConf['reflectionPNG']     = $this->getFlexformData('reflection', 'reflectionPNG');
			$this->lConf['reflectionP']       = $this->getFlexformData('reflection', 'reflectionP');

			$this->lConf['xStep']             = $this->getFlexformData('other', 'xStep');
			$this->lConf['startID']           = $this->getFlexformData('other', 'startID');
			$this->lConf['glideToStartID']    = $this->getFlexformData('other', 'glideToStartID');
			$this->lConf['startAnimation']    = $this->getFlexformData('other', 'startAnimation');

			$this->lConf['options']           = $this->getFlexformData('special', 'options');
			$this->lConf['optionsOverride']   = $this->getFlexformData('special', 'optionsOverride');

			// define the key of the element
			$this->setContentKey($this->extKey . "_c" . $this->cObj->data['uid']);

			// define the images
			switch ($this->lConf['mode']) {
				case "" : {}
				case "folder" : {}
				case "upload" : {
					$this->setDataUpload();
					// Set the descriptions
					if ($this->lConf['descriptions']) {
						$this->description = t3lib_div::trimExplode(",", $this->lConf['descriptions']);
					}
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

			// image
			if ($this->lConf['imagewidth']) {
				$this->conf['imagewidth'] = $this->lConf['imagewidth'];
			}
			if ($this->lConf['imageheight']) {
				$this->conf['imageheight'] = $this->lConf['imageheight'];
			}
			if ($this->lConf['imageFocusMax']) {
				$this->conf['imageFocusMax'] = $this->lConf['imageFocusMax'];
			}
			if ($this->lConf['percentLandscape']) {
				$this->conf['percentLandscape'] = $this->lConf['percentLandscape'];
			}
			if ($this->lConf['percentOther']) {
				$this->conf['percentOther'] = $this->lConf['percentOther'];
			}
			if ($this->lConf['imageCursor']) {
				$this->conf['imageCursor'] = $this->lConf['imageCursor'];
			}
			if ($this->lConf['imageScaling'] < 2) {
				$this->conf['imageScaling'] = $this->lConf['imageScaling'];
			}
			if ($this->lConf['opacity'] < 2) {
				$this->conf['opacity'] = $this->lConf['opacity'];
			}
			if ($this->lConf['preloadImages'] < 2) {
				$this->conf['preloadImages'] = $this->lConf['preloadImages'];
			}
			if ($this->lConf['imageFocusM']) {
				$this->conf['imageFocusM'] = $this->lConf['imageFocusM'];
			}
			if ($this->lConf['imagesHeight']) {
				$this->conf['imagesHeight'] = $this->lConf['imagesHeight'];
			}
			if ($this->lConf['imagesM']) {
				$this->conf['imagesM'] = $this->lConf['imagesM'];
			}

			// movement
			if ($this->lConf['animationSpeed']) {
				$this->conf['animationSpeed'] = $this->lConf['animationSpeed'];
			}
			if ($this->lConf['slideshowSpeed']) {
				$this->conf['slideshowSpeed'] = $this->lConf['slideshowSpeed'];
			}
			if ($this->lConf['captionsToggle'] < 2) {
				$this->conf['captionsToggle'] = $this->lConf['captionsToggle'];
			}
			if ($this->lConf['circular'] < 2) {
				$this->conf['circular'] = $this->lConf['circular'];
			}
			if ($this->lConf['slideshowAutoplay'] < 2) {
				$this->conf['slideshowAutoplay'] = $this->lConf['slideshowAutoplay'];
			}
			if ($this->lConf['aspectRatio']) {
				$this->conf['aspectRatio'] = $this->lConf['aspectRatio'];
			}

			// control
			if ($this->lConf['sliderWidth']) {
				$this->conf['sliderWidth'] = $this->lConf['sliderWidth'];
			}
			if ($this->lConf['sliderCursor']) {
				$this->conf['sliderCursor'] = $this->lConf['sliderCursor'];
			}
			if ($this->lConf['buttons'] < 2) {
				$this->conf['buttons'] = $this->lConf['buttons'];
			}
			if ($this->lConf['slider'] < 2) {
				$this->conf['slider'] = $this->lConf['slider'];
			}
			if ($this->lConf['slideshow'] < 2) {
				$this->conf['slideshow'] = $this->lConf['slideshow'];
			}
			if ($this->lConf['scrollbarP']) {
				$this->conf['scrollbarP'] = $this->lConf['scrollbarP'];
			}

			// reflection
			if ($this->lConf['reflectionGET']) {
				$this->conf['reflectionGET'] = $this->lConf['reflectionGET'];
			}
			if (strlen($this->lConf['backgroundColor']) == 6) {
				$this->conf['backgroundColor'] = $this->lConf['backgroundColor'];
			}
			if ($this->lConf['reflections'] < 2) {
				$this->conf['reflections'] = $this->lConf['reflections'];
			}
			if ($this->lConf['reflectionPNG'] < 2) {
				$this->conf['reflectionPNG'] = $this->lConf['reflectionPNG'];
			}
			if ($this->lConf['reflectionP']) {
				$this->conf['reflectionP'] = $this->lConf['reflectionP'];
			}

			// other
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

			// special
			if ($this->lConf['options']) {
				$this->conf['options'] = $this->lConf['options'];
			}
			if ($this->lConf['optionsOverride'] < 2) {
				$this->conf['optionsOverride'] = $this->lConf['optionsOverride'];
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
		$this->pagerenderer = t3lib_div::makeInstance('tx_imagecarousel_pagerenderer');
		$this->pagerenderer->setConf($this->conf);

		// define the directory of images
		if ($dir == '') {
			$dir = $this->imageDir;
		}

		// define the contentKey if not exist
		if ($this->getContentKey() == '') {
			$this->setContentKey($this->extKey . '_key');
		}

		// The template for JS
		if (! $this->templateFileJS = $this->cObj->fileResource($this->conf['templateFileJS'])) {
			$this->templateFileJS = $this->cObj->fileResource("EXT:jfimageflow/res/tx_jfimageflow.js");
		}

		// define the js files
		$this->pagerenderer->addJsFile($this->conf['imageFlowJS']);
		$this->pagerenderer->addCssFile($this->conf['imageFlowCSS']);

		// get the options from config
		$options = array();
		$options['ImageFlowID'] = "ImageFlowID: '{$this->getContentKey()}'";
		$options['imagePath']   = "imagePath: '{$this->conf['imagePath']}'";
		$options['reflectPath'] = "reflectPath: '{$this->conf['reflectPath']}'";

		if ($this->conf['imageFocusMax'] > 0) {
			$options['imageFocusMax'] = "imageFocusMax: {$this->conf['imageFocusMax']}";
		}
		if ($this->conf['percentLandscape'] > 0) {
			$options['percentLandscape'] = "percentLandscape: {$this->conf['percentLandscape']}";
		}
		if ($this->conf['percentOther'] > 0) {
			$options['percentOther'] = "percentOther: {$this->conf['percentOther']}";
		}
		if ($this->conf['imageCursor']) {
			$options['imageCursor'] = "imageCursor: '{$this->conf['imageCursor']}'";
		}
		if (strlen($this->conf['imageScaling'])) {
			$options['imageScaling'] = "imageScaling: ".($this->conf['imageScaling'] ? 'true' : 'false');
		}
		if (strlen($this->conf['opacity'])) {
			$options['opacity'] = "opacity: ".($this->conf['opacity'] ? 'true' : 'false');
		}
		if (strlen($this->conf['preloadImages'])) {
			$options['preloadImages'] = "preloadImages: ".($this->conf['preloadImages'] ? 'true' : 'false');
		}
		if ($this->conf['imageFocusM'] > 0) {
			$options['imageFocusM'] = "imageFocusM: {$this->conf['imageFocusM']}";
		}
		if ($this->conf['imagesHeight'] > 0) {
			$options['imagesHeight'] = "imagesHeight: {$this->conf['imagesHeight']}";
		}
		if ($this->conf['imagesM'] > 0) {
			$options['imagesM'] = "imagesM: {$this->conf['imagesM']}";
		}

		if (is_numeric($this->conf['animationSpeed'])) {
			$options['animationSpeed'] = "animationSpeed: {$this->conf['animationSpeed']}";
		}
		if ($this->conf['slideshowSpeed'] > 0) {
			$options['slideshowSpeed'] = "slideshowSpeed: {$this->conf['slideshowSpeed']}";
		}
		if (strlen($this->conf['captionsToggle'])) {
			$options['captionsToggle'] = "captions: ".($this->conf['captionsToggle'] ? 'true' : 'false');
		}
		if (strlen($this->conf['circular'])) {
			$options['circular'] = "circular: ".($this->conf['circular'] ? 'true' : 'false');
		}
		if (strlen($this->conf['slideshowAutoplay'])) {
			$options['slideshowAutoplay'] = "slideshowAutoplay: ".($this->conf['slideshowAutoplay'] ? 'true' : 'false');
		}
		if ($this->conf['aspectRatio'] > 0) {
			$options['aspectRatio'] = "aspectRatio: {$this->conf['aspectRatio']}";
		}

		if ($this->conf['sliderWidth'] > 0) {
			$options['sliderWidth'] = "sliderWidth: {$this->conf['sliderWidth']}";
		}
		if ($this->conf['sliderCursor']) {
			$options['sliderCursor'] = "sliderCursor: '{$this->conf['sliderCursor']}'";
		}
		if (strlen($this->conf['buttons'])) {
			$options['buttons']  = "buttons: ".($this->conf['buttons'] ? 'true' : 'false');
		}
		if (strlen($this->conf['slider'])) {
			$options['slider'] = "slider: ".($this->conf['slider'] ? 'true' : 'false');
		}
		if (strlen($this->conf['slideshow'])) {
			$options['slideshow'] = "slideshow: ".($this->conf['slideshow'] ? 'true' : 'false');
		}
		if ($this->conf['scrollbarP'] > 0) {
			$options['scrollbarP'] = "scrollbarP: {$this->conf['scrollbarP']}";
		}

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
		if (strlen($this->conf['reflections'])) {
			$options['reflections'] = "reflections: ".($this->conf['reflections'] ? 'true' : 'false');
		}
		if (strlen($this->conf['reflectionPNG'])) {
			$options['reflectionPNG'] = "reflectionPNG: ".($this->conf['reflectionPNG'] ? 'true' : 'false');
		}
		if ($this->conf['reflectionP'] > 0) {
			$options['reflectionP'] = "reflectionP: {$this->conf['reflectionP']}";
		}

		if ($this->conf['xStep'] > 0) {
			$options['xStep'] = "xStep: {$this->conf['xStep']}";
		}
		if ($this->conf['startID'] > 0) {
			$options['startID'] = "startID: {$this->conf['startID']}";
		}
		if (strlen($this->conf['glideToStartID'])) {
			$options['glideToStartID'] = "glideToStartID: ".($this->conf['glideToStartID'] ? 'true' : 'false');
		}
		if (strlen($this->conf['startAnimation'])) {
			$options['startAnimation'] = "startAnimation: ".($this->conf['startAnimation'] ? 'true' : 'false');
		}

		// overwrite all options if set
		if (trim($this->conf['options'])) {
			if ($this->conf['optionsOverride']) {
				$options = array($this->conf['options']);
			} else {
				$options['options'] = $this->conf['options'];
			}
		}

		// define the markers
		$markerArray = array();
		$markerArray["KEY"]     = $this->getContentKey();
		$markerArray["OPTIONS"] = implode(",\n		", $options);

		// get the Template of the Javascript
		if (! $templateCode = trim($this->cObj->getSubpart($this->templateFileJS, "###TEMPLATE_JS###"))) {
			$templateCode = "alert('Template TEMPLATE_JS is missing')";
		}
		$this->pagerenderer->addJS($this->cObj->substituteMarkerArray($templateCode, $markerArray, '###|###', 0));

		// Add the ressources
		$this->pagerenderer->addResources();

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
		if (count($this->images) > 0) {
			$config = $this->conf['imageflow.'][$this->type.'.'];
			$key = 0;
			foreach ($this->images as $image_name) {
				$image = null;
				$imgConf = $config['image.'];
				$totalImagePath = $this->imageDir . $image_name;
				$GLOBALS['TSFE']->register['file']        = $totalImagePath;
				$GLOBALS['TSFE']->register['href']        = $this->hrefs[$key];
				$GLOBALS['TSFE']->register['caption']     = $this->captions[$key];
				$GLOBALS['TSFE']->register['description'] = $this->description[$key];
				$GLOBALS['TSFE']->register['CURRENT_ID']  = $key + 1;
				$GLOBALS['TSFE']->register['IMAGE_ID']    = $key;
				$images .= $this->cObj->IMAGE($imgConf);
				$description .= $this->cObj->cObjGetSingle($config['description'], $config['description.']);
				$key ++;
			}
			// the stdWrap
			$images = $this->cObj->stdWrap($images, $config['stdWrap.']);
			$description = $this->cObj->stdWrap($description, $config['descriptionWrap.']);

			$return_string = $this->cObj->substituteMarkerArray($images . $description, $markerArray, '###|###', 0);
		}
		return $this->pi_wrapInBaseClass($return_string);
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jfimageflow/pi1/class.tx_jfimageflow_pi1.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jfimageflow/pi1/class.tx_jfimageflow_pi1.php']);
}
?>