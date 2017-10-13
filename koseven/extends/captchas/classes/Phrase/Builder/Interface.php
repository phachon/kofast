<?php
/**
 * Interface for the PhraseBuilder
 *
 * @author Gregwar <g.passault@gmail.com>
 * update by phachon@163.com
 */
interface Phrase_Builder_Interface {
    /**
     * Generates  random phrase of given length with given charset
     * @param $length
     * @param $charset
     * @return
     */
    public function build($length, $charset);

    /**
     * "Niceize" a code
     * @param $str
     * @return
     */
    public function niceize($str);
}
