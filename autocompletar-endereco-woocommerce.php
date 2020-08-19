<?php

/**
 * Plugin Name: Autocomplete address by CEP Brazil woocommerce
 * Plugin URI:https://github.com/jorgeslima/autocompletar-endereco-woocommerce
 * Description: Plugin autocomplete address by CEP Brazil
 * Version: 1.1
 * Author: <a href="https://testeemproducao.com.br/">Bayma Bruno</a> / <a href="https://creativeconcept.com.br">Jorge Lima</a>
 */

/**
 * Copyright (c) <2020>, <Bruno Bayma> <baymabruno@gmail.com>
 * Permission to use, copy, modify, and distribute this software for any
 * purpose with or without fee is hereby granted, provided that the above
 * copyright notice and this permission notice appear in all copies.
 *
 * THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES
 * WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR
 * ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES
 * WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN
 * ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
 * OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.
 */

 /**
  * To do:
  * - Add setings page to be possible to change the fields ID's
  * - Add possibility to change the search api (So if one API is down we can easily change it)
  * - Add possibility to users change the error messages
  * - Add possibility to users change the loading message/icon
  */
 class WooCommerceAutocopleteBrazilianZip{

    public function __construct(){
        add_action('wp_enqueue_scripts', array($this,'wcabz_registerScripts'));
    }

    public static function init() {
        $class = __CLASS__;
        new $class;
    }

    public function wcabz_registerScripts(){
        if( function_exists( 'is_woocommerce' ) ){
            if(is_checkout()){
                wp_enqueue_script( 'wabz-parser', plugin_dir_url( __FILE__ ) . 'js/jquery.wabz.js', array('jquery'), '1.0.0', true );
            }
        }
    }
 }
 add_action( 'plugins_loaded', array( 'WooCommerceAutocopleteBrazilianZip', 'init' ));