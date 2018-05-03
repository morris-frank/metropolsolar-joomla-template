/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.2
 */

function fnWrapper(e) {
  var header          = document.querySelector('header');
  var secHead        = document.querySelector("section.head");
  var shrinkHeader = 40;

  function shrinkyScroll(e) {
    if( window.pageYOffset > shrinkHeader ) {
      header.className = "shrink";
    }else{
      header.className = "";
    }
    if(secHead != null) {
      var posY = -245 - (window.pageYOffset/3)
      secHead.style.backgroundPosition = "50%" + posY.toString() +"px";
    }
  }

  window,addEventListener('scroll', shrinkyScroll, false);
}


document.addEventListener('DOMContentLoaded', fnWrapper, false);
