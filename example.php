<?php

require_once('htmlpurifier_html5.php');

define('LIB_DIR', getcwd() . 'lib/');

// EDIT: modify this to whatever you need.
$allowed = array(
  'img[src|alt|title|width|height|style|data-mce-src|data-mce-json]',
  'figure', 'figcaption',
  'video[src|type|width|height|poster|preload|controls]', 'source[src|type]',
  'a[href|target]',
  'iframe[width|height|src|frameborder|allowfullscreen]',
  'strong', 'b', 'i', 'u', 'em', 'br', 'font',
  'h1[style]', 'h2[style]', 'h3[style]', 'h4[style]', 'h5[style]', 'h6[style]',
  'p[style]', 'div[style]', 'center', 'address[style]',
  'span[style]', 'pre[style]',
  'ul', 'ol', 'li',
  'table[width|height|border|style]', 'th[width|height|border|style]',
  'tr[width|height|border|style]', 'td[width|height|border|style]',
  'hr'
);

$purifier = load_htmlpurifier($allowed);

