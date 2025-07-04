<?php
//if (! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Academic Free License version 3.0
 *
 * This source file is subject to the Academic Free License (AFL 3.0) that is
 * bundled with this package in the files license_afl.txt / license_afl.rst.
 * It is also available through the world wide web at this URL:
 * http://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world wide web, please send an email to
 * licensing@ellislab.com so we can send you a copy immediately.
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2012, EllisLab, Inc. (http://ellislab.com/)
 * @license		http://opensource.org/licenses/AFL-3.0 Academic Free License (AFL 3.0)
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
/*
| -------------------------------------------------------------------
| MIME TYPES
| -------------------------------------------------------------------
| This file contains an array of mime types. It is used by the
| Upload class to help identify allowed file types.
|
*/
$mimes = array(
				//'hqx'	=>	array('application/mac-binhex40', 'application/mac-binhex', 'application/x-binhex40', 'application/x-mac-binhex40'),
				//'cpt'	=>	'application/mac-compactpro',
				//'csv'	=>	array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel'),
				//'bin'	=>	array('application/macbinary', 'application/mac-binary', 'application/octet-stream', 'application/x-binary', 'application/x-macbinary'),
				//'dms'	=>	'application/octet-stream',
				//'lha'	=>	'application/octet-stream',
				//'lzh'	=>	'application/octet-stream',
				//'exe'	=>	array('application/octet-stream', 'application/x-msdownload'),
				//'class'	=>	'application/octet-stream',
				//'psd'	=>	'application/x-photoshop',
				//'so'	=>	'application/octet-stream',
				//'sea'	=>	'application/octet-stream',
				//'dll'	=>	'application/octet-stream',
				//'oda'	=>	'application/oda',
				//'pdf'	=>	array('application/pdf', 'application/x-download'),
				//'ai'	=>	'application/postscript',
				//'eps'	=>	'application/postscript',
				//'ps'	=>	'application/postscript',
				//'smi'	=>	'application/smil',
				//'smil'	=>	'application/smil',
				//'mif'	=>	'application/vnd.mif',
				//'xls'	=>	array('application/excel', 'application/vnd.ms-excel', 'application/msexcel'),
				//'ppt'	=>	array('application/powerpoint', 'application/vnd.ms-powerpoint'),
				//'pptx'	=> 	'application/vnd.openxmlformats-officedocument.presentationml.presentation',
				//'wbxml'	=>	'application/wbxml',
				//'wmlc'	=>	'application/wmlc',
				//'dcr'	=>	'application/x-director',
				//'dir'	=>	'application/x-director',
				//'dxr'	=>	'application/x-director',
				//'dvi'	=>	'application/x-dvi',
				//'gtar'	=>	'application/x-gtar',
				//'gz'	=>	'application/x-gzip',
				//'gzip' =>	'application/x-gzip',
				//'php'	=>	'application/x-httpd-php',
				//'php4'	=>	'application/x-httpd-php',
				//'php3'	=>	'application/x-httpd-php',
				//'phtml'	=>	'application/x-httpd-php',
				//'phps'	=>	'application/x-httpd-php-source',
				//'js'	=>	'application/x-javascript',
				//'swf'	=>	'application/x-shockwave-flash',
				//'sit'	=>	'application/x-stuffit',
				//'tar'	=>	'application/x-tar',
				//'tgz'	=>	array('application/x-tar', 'application/x-gzip-compressed'),
				//'xhtml'	=>	'application/xhtml+xml',
				//'xht'	=>	'application/xhtml+xml',
				//'zip'	=>	array('application/x-zip', 'application/zip', 'application/x-zip-compressed'),
				//'mid'	=>	'audio/midi',
				//'midi'	=>	'audio/midi',
				//'mpga'	=>	'audio/mpeg',
				//'mp2'	=>	'audio/mpeg',
				//'mp3'	=>	array('audio/mpeg', 'audio/mpg', 'audio/mpeg3', 'audio/mp3'),
				//'aif'	=>	array('audio/x-aiff', 'audio/aiff'),
				//'aiff'	=>	array('audio/x-aiff', 'audio/aiff'),
				//'aifc'	=>	'audio/x-aiff',
				//'ram'	=>	'audio/x-pn-realaudio',
				//'rm'	=>	'audio/x-pn-realaudio',
				//'rpm'	=>	'audio/x-pn-realaudio-plugin',
				//'ra'	=>	'audio/x-realaudio',
				//'rv'	=>	'video/vnd.rn-realvideo',
				//'wav'	=>	array('audio/x-wav', 'audio/wave', 'audio/wav'),
				'bmp'	=>	array('image/bmp', 'image/x-windows-bmp'),
				'gif'	=>	'image/gif',
				'jpeg'	=>	array('image/jpeg', 'image/pjpeg'),
				'jpg'	=>	array('image/jpeg', 'image/pjpeg'),
				'jpe'	=>	array('image/jpeg', 'image/pjpeg'),
				'png'	=>	array('image/png', 'image/x-png'),
				'tiff'	=>	'image/tiff',
				'tif'	=>	'image/tiff',
				//'css'	=>	'text/css',
				//'html'	=>	'text/html',
				//'htm'	=>	'text/html',
				//'shtml'	=>	'text/html',
				//'txt'	=>	'text/plain',
				//'text'	=>	'text/plain',
				//'log'	=>	array('text/plain', 'text/x-log'),
				//'rtx'	=>	'text/richtext',
				//'rtf'	=>	'text/rtf',
				//'xml'	=>	array('application/xml', 'text/xml'),
				//'xsl'	=>	array('application/xml', 'text/xsl', 'text/xml'),
				//'mpeg'	=>	'video/mpeg',
				//'mpg'	=>	'video/mpeg',
				//'mpe'	=>	'video/mpeg',
				//'qt'	=>	'video/quicktime',
				//'mov'	=>	'video/quicktime',
				//'avi'	=>	array('video/x-msvideo', 'video/msvideo', 'video/avi', 'application/x-troff-msvideo'),
				//'movie'	=>	'video/x-sgi-movie',
				//'doc'	=>	'application/msword',
				//'docx'	=>	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				//'xlsx'	=>	'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
				//'word'	=>	array('application/msword', 'application/octet-stream'),
				//'xl'	=>	'application/excel',
				//'eml'	=>	'message/rfc822',
				//'json' =>	array('application/json', 'text/json'),
				//'pem' =>	array('application/x-x509-user-cert', 'application/x-pem-file', 'application/octet-stream'),
				//'p10' =>	array('application/x-pkcs10', 'application/pkcs10'),
				//'p12' =>	'application/x-pkcs12',
				//'p7a' =>	'application/x-pkcs7-signature',
				//'p7c' =>	array('application/pkcs7-mime', 'application/x-pkcs7-mime'),
				//'p7m' =>	array('application/pkcs7-mime', 'application/x-pkcs7-mime'),
				//'p7r' =>	'application/x-pkcs7-certreqresp',
				//'p7s' =>	'application/pkcs7-signature',
				//'crt' =>	array('application/x-x509-ca-cert', 'application/x-x509-user-cert', 'application/pkix-cert'),
				//'crl' =>	array('application/pkix-crl', 'application/pkcs-crl'),
				//'der' =>	'application/x-x509-ca-cert',
				//'kdb' =>	'application/octet-stream',
				//'pgp' =>	'application/pgp',
				//'gpg' =>	'application/gpg-keys',
				//'sst' =>	'application/octet-stream',
				//'csr' =>	'application/octet-stream',
				//'rsa' =>	'application/x-pkcs7',
				//'cer' =>	array('application/pkix-cert', 'application/x-x509-ca-cert'),
				//'3g2' =>	'video/3gpp2',
				//'3gp' =>	'video/3gp',
				//'mp4' =>	'video/mp4',
				//'m4a' =>	'audio/x-m4a',
				//'f4v' =>	'video/mp4',
				//'aac' =>	'audio/x-acc',
				//'m4u' =>	'application/vnd.mpegurl',
				//'m3u' =>	'text/plain',
				//'xspf' =>	'application/xspf+xml',
				//'vlc' =>	'application/videolan',
				//'wmv' =>	'video/x-ms-wmv',
				//'au' =>	'audio/x-au',
				//'ac3' =>	'audio/ac3',
				//'flac' =>	'audio/x-flac',
				//'ogg' =>	'audio/ogg',
				//'kmz'	=>	array('application/vnd.google-earth.kmz', 'application/zip', 'application/x-zip'),
				//'kml'	=>	array('application/vnd.google-earth.kml+xml', 'application/xml', 'text/xml')
			);
/* End of file mimes.php */
/* Location: lib/mimes.php */
?>