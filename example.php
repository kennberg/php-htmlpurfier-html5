<?php

define('LIB_DIR', getcwd() . '/lib/');

require_once('htmlpurifier_html5.php');

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

$content = <<<EOT
<h1>HTMLPurifier HTML5 Demo</h1>
<p>
  <iframe width="560" height="315" src="//www.youtube.com/embed/5SS77cgAjNw" frameborder="0" allowfullscreen></iframe>
</p>
<p>
<video controls preload="none" poster="//www.videojs.com/img/poster.jpg">
  <source src="//vjs.zencdn.net/v/oceans.mp4" type="video/mp4">
  <source src="//vjs.zencdn.net/v/oceans.webm" type="video/webm">
</video>
</p>
EOT;

echo $purifier->purify($content);

