<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	
	var $allowedFileTypes = array(
		'jpg' => array('image/jpeg', 'image/pjpeg'),
		'jpeg' => array('image/jpeg', 'image/pjpeg'),
		'gif' => array('image/gif'),
		'png' => array('image/png','image/x-png'),
		'pdf' => array('application/pdf'),
		'bmp' => array(),
		'doc' => array(),
		'docx' => array(),
	);
	
	// #########################################################################
	// Métodos #################################################################
	public function imageCrop($fullPath, $newFileFullPath, $options) {  
		$filetype = exif_imagetype($fullPath);
		$allowedTypes = array( 
			1,	// gif 
			2,	// jpg 
			3,	// png 
//			6	// bmp 
		);
		if(!in_array($filetype, $allowedTypes)) { 
			return false; 
		} 
		switch($filetype){
			case 1:
				$imgSrc = imagecreatefromgif($fullPath);
			break;
			case 2:
				$imgSrc = imagecreatefromjpeg($fullPath);
			break;
			case 3:
				$imgSrc = imagecreatefrompng($fullPath);
			break;
		}

		$width = imagesx($imgSrc);
		$height = imagesy($imgSrc);

		$originalAspect = $width / $height;
		$thumbAspect = $options['width'] / $options['height'];

		if($originalAspect >= $thumbAspect) {
			// If image is wider than thumbnail (in aspect ratio sense)
			$newHeight = $options['height'];
			$newWidth = $width / ($height / $options['height']);
		}
		else {
			// If the thumbnail is wider than the image
			$newWidth = $options['width'];
			$newHeight = $height / ($width / $options['width']);
		}

		//-- Calculate cropping (division by zero)
		$cropX = ($newWidth - $options['width'] != 0) ? ($newWidth - $options['width']) / 2 : 0;
		$cropY = ($newHeight - $options['height'] != 0) ? ($newHeight - $options['height']) / 2 : 0;

		//-- Setup Resample & Crop buffers
		$resampled = imagecreatetruecolor($newWidth, $newHeight);
		$cropped = imagecreatetruecolor($options['width'], $options['height']);

		//-- Resample
		imagecopyresampled($resampled, $imgSrc, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
		//-- Crop
		imagecopy($cropped, $resampled, 0, 0, $cropX, $cropY, $newWidth, $newHeight);

		// Save the cropped image
		switch($filetype) {
			case 1:
				imagegif($cropped,$newFileFullPath);
			break;
			case 2:
				imagejpeg($cropped,$newFileFullPath,100);
			break;
			case 3:
				imagepng($cropped,$newFileFullPath,9);
			break;
		}
	}
	public function deleteFile($filePath) {
		if(file_exists($filePath)) {
			if(!unlink($filePath)) {
				return false;
			}
		}
		
		$file = substr(strrchr($filePath, '/'), 1);
		$path = substr($filePath, 0, -(strlen($file)+1));
		$childrenPath = scandir($path);
		foreach($childrenPath as $childPath) {
			if(is_file($childPath)) {
				continue;
			}
			$filePath = "$path/$childPath/$file";
			if(file_exists($filePath)) {
				if(!unlink($filePath)) {
					return false;
				}
			}
		}
		return true;
	}
	public function getUploadedFilePath($file, $path) {
		if(empty($file['size'])) {
			return false;
		}
		if($file['size'] > 3000000) {
			return false;
		}
		
		$filePath = $this->getNewFilePath($path, $file['name']);
		if(!$filePath) {
			return false;
		}
		
		if(!move_uploaded_file($file['tmp_name'], $filePath)){
			return false;
		}
		return $filePath;
	}
	public function beforeSaveBrFloat(&$floatInput) {
		if(!$floatInput) {
			return true;
		}
		$floatInput = str_replace('.', '', $floatInput);
		$floatInput = str_replace(',', '.', $floatInput);
	}
	public function beforeSaveBrDate(&$dateTimeInput) {
		if(!$dateTimeInput) {
			$dateTimeInput = null;
			return true;
		}
		$dateTimeInput = date('Y-m-d', strtotime(str_replace('/', '-', $dateTimeInput)));
	}
	public function beforeSaveBrDatetime(&$dateTimeInput) {
		if(!$dateTimeInput) {
			$dateTimeInput = null;
			return true;
		}
		$dateTimeInput = date('Y-m-d G:i:s', strtotime(str_replace('/', '-', $dateTimeInput)));
	}
	public function beforeSaveBrDatetimeMax(&$dateTimeInput) {
		if(!$dateTimeInput) {
			$dateTimeInput = null;
			return true;
		}
		$dateTimeInput = date('Y-m-d 23:59:59', strtotime(str_replace('/', '-', $dateTimeInput)));
	}
	public function loadModel($modelName) {
		App::import('Model', $modelName);
		$this->$modelName = new $modelName();
	}
	
	public function fixBrNumber($number) {
		return str_replace(',', '.', str_replace('.', '', $number));
	}
	public function booleanSimNao($simNao) {
		if('Sim' == $simNao) {
			return true;
		}
		return false;
	}
	
	// #########################################################################
	// Métodos privados ########################################################
	private function getExtension($fileName) {
		$exploded = explode(".", $fileName);
		return strtolower(end($exploded));
	}
	private function getNewFilePath($path, $fileName) {
		$extension = $this->getExtension($fileName);
		if(!isset($this->allowedFileTypes[$extension])) {
			return false;
		}
		
		$finalPath = "files/$path";
		
		if(!file_exists($finalPath)) {
			mkdir($finalPath);
		}
		
		$count = 0;
		$sluggedName = Inflector::slug(substr($fileName, 0, -1-strlen($extension)));
		$filePath = "$finalPath/$sluggedName.$extension";
		
		while(file_exists($filePath)) {
			$count++;
			
			$filePath = "files/$path/$sluggedName";
			$filePath.= "_$count.$extension";
		}
		return $filePath;
	}
}
