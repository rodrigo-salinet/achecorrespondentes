/**
 * The Indonesian (Bahasa Indonesia) language file for Shadowbox.
 *
 * This file is part of Shadowbox.
 *
 * Shadowbox is an online media viewer application that supports all of the
 * web's most popular media publishing formats. Shadowbox is written entirely
 * in JavaScript and CSS and is highly customizable. Using Shadowbox, website
 * authors can showcase a wide assortment of media in all major browsers without
 * navigating users away from the linking page.
 *
 * Shadowbox is released under version 3.0 of the Creative Commons Attribution-
 * Noncommercial-Share Alike license. This means that it is absolutely free
 * for personal, noncommercial use provided that you 1) make attribution to the
 * author and 2) release any derivative work under the same or a similar
 * license.
 *
 * If you wish to use Shadowbox for commercial purposes, licensing information
 * can be found at http://mjijackson.com/shadowbox/.
 *
 * @author Michael J. I. Jackson <mjijackson@gmail.com>
 * @copyright 2007-2008 Michael J. I. Jackson
 * @license http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @version SVN: $Id: shadowbox-id.js 100 2008-06-23 02:31:30Z mjijackson $
 */

if(typeof Shadowbox == 'undefined'){
 throw 'Unable to load Shadowbox language file, base library not found.';
}

/**
 * An object containing all textual messages to be used in Shadowbox. These are
 * provided so they may be translated into different languages. Alternative
 * translations may be found in js/lang/shadowbox-*.js where * is an abbreviation
 * of the language name (see
 * http://www.gnu.org/software/gettext/manual/gettext.html#Language-Codes).
 *
 * @var {Object} LANG
 * @public
 * @static
 */
Shadowbox.LANG = {

 code: 'id',

 of: 'dari',

 loading: 'pengisian',

 cancel: 'Batal',

 next: 'Berikut',

 previous: 'Sebelum',

 play: 'Mainkan',

 pause: 'Hentikan',

 close: 'Tutup',

 errors: {
 single: 'Anda harus memasang plugin browser <a href="{0}">{1}</a> untuk melihat isi ini.',
 shared: 'Anda harus memasang kedua plugin browser <a href="{0}">{1}</a> dan <a href="{2}">{3}</a> untuk melihat isi ini.',
 either: 'Anda harus memasang plugin browser <a href="{0}">{1}</a> atau <a href="{2}">{3}</a> untuk melihat isi ini.'
 }

}
