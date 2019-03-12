<?php

/////////////////// ODT //////////////////////
define('DIR_ROOT',str_replace("/catalog","",DIR_APPLICATION));
define('DIR_WEBROOT', DIR_ROOT.'image/data/webroot/');
define('HTTP_WEBROOT', 'image/data/webroot/');
define('HTTP_IMAGE', 'image/');
//HTTP_SERVER.
define('IMAGEMAGICPATH', "/usr/local/bin/convert");
define('IMAGEMAGICCOMPOSITEPATH', "/usr/bin/composite");

define('_FONTORIGINAL_', DIR_WEBROOT . "font/original/");
define('_FONTTTF_', DIR_WEBROOT . "font/ttf/");
define('FONTPATH', HTTP_WEBROOT . "font/original/");
// raw product
define('_RAWPRODUCTORIGINAL_', DIR_WEBROOT . "product/original/");
define('_RAWPRODUCT_41x41_', DIR_WEBROOT . "product/41x41/");
define('_RAWPRODUCT_500x500_', DIR_WEBROOT . "product/500x500/");
define('_RAWPRODUCTTHUMB_', DIR_WEBROOT . "product/thumb/");

define('RAWPRODUCTORIGINAL', HTTP_WEBROOT . "product/original/");
define('RAWPRODUCT_41x41', HTTP_WEBROOT . "product/41x41/");
define('RAWPRODUCT_500x500', HTTP_WEBROOT . "product/500x500/");
define('RAWPRODUCTTHUMB', HTTP_WEBROOT . "product/thumb/");

define('_GENIMG_', DIR_WEBROOT . "genimg/");
define('GENIMG', HTTP_WEBROOT . "genimg/");

define('_CLIPART_ORIGINAL_', DIR_WEBROOT . "clipart/original/");
define('_CLIPART_300X300_', DIR_WEBROOT . "clipart/300x300/");
define('_CLIPART_45X45_', DIR_WEBROOT . "clipart/45x45/");

define('CLIPART_ORIGINAL', HTTP_WEBROOT . "clipart/original/");
define('CLIPART_45X45', HTTP_WEBROOT . "clipart/45x45/");
define('CLIPART_300X300', HTTP_WEBROOT . "clipart/300x300/");

define('_MAINPRODUCT_ORIGINAL_', DIR_WEBROOT . "mainproduct/original/");
define('_MAINPRODUCT_500x500_', DIR_IMAGE . "data/product/");

define('MAINPRODUCT_ORIGINAL', HTTP_WEBROOT . "mainproduct/original/");
define('MAINPRODUCT_500x500', HTTP_IMAGE . "data/product/");
define('MAINPRODUCT_500x500_SAVE', "data/product/");

define('_USERUPLOAD_ORIGINAL_', DIR_WEBROOT . "userupload/original/");
define('_USERUPLOAD_300x300_', DIR_WEBROOT . "userupload/300x300/");
define('_USERUPLOAD_45x45_', DIR_WEBROOT . "userupload/45x45/");

define('USERUPLOAD_ORIGINAL', HTTP_WEBROOT . "userupload/original/");
define('USERUPLOAD_300x300', HTTP_WEBROOT . "userupload/300x300/");
define('USERUPLOAD_45x45', HTTP_WEBROOT . "userupload/45x45/");

define('_PDF_', DIR_WEBROOT . "pdf/");
define('_PDFPRODUCTION_', DIR_WEBROOT . "pdf/PDF/");
define('PDF', HTTP_WEBROOT . "pdf/");
define('PDFPRODUCTION', HTTP_WEBROOT . "pdf/PDF/");
?>