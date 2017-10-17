<?php
/**
 * A Captcha builder
 */
interface Captcha_Builder_Interface {

	/**
	 * Builds the code
	 * @param $width
	 * @param $height
	 * @param $font
	 * @param $fingerprint
	 * @return
	 */
	public function build($width, $height, $font, $fingerprint);

	/**
	 * Saves the code to a file
	 * @param $filename
	 * @param $quality
	 * @return
	 */
	public function save($filename, $quality);

	/**
	 * Gets the image contents
	 * @param $quality
	 * @return
	 */
	public function get($quality);

	/**
	 * Outputs the image
	 * @param $quality
	 * @return
	 */
	public function output($quality);
}

