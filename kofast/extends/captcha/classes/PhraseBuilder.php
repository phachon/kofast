<?php

/**
 * Generates random phrase
 *
 * @author Gregwar <g.passault@gmail.com>
 * update by phachon@163.com
 */
class PhraseBuilder implements Phrase_Builder_Interface
{

	/**
	 * Generates  random phrase of given length with given charset
	 * @param int $length
	 * @param string $charset
	 * @return string
	 */
	public function build($length = 5, $charset = 'abcdefghijklmnpqrstuvwxyz123456789')
	{
		$phrase = '';
		$chars = str_split($charset);

		for ($i = 0; $i < $length; $i++) {
			$phrase .= $chars[array_rand($chars)];
		}

		return $phrase;
	}

	/**
	 * "Niceize" a code
	 * @param $str
	 * @return string
	 */
	public function niceize($str)
	{
		return strtr(strtolower($str), '01', 'ol');
	}
}
