<?php
/**
 * Load HTMLPurifier with HTML5, TinyMCE, YouTube, Video support.
 *
 * Copyright 2014 Alex Kennberg (https://github.com/kennberg/php-htmlpurifier-html5)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

require_once(LIB_DIR . 'third-party/htmlpurifier/HTMLPurifier.safe-includes.php');


function load_htmlpurifier($allowed) {
  $config = HTMLPurifier_Config::createDefault();
  $config->set('HTML.Doctype', 'HTML 4.01 Transitional');
  $config->set('CSS.AllowTricky', true);
  $config->set('Cache.SerializerPath', '/tmp/shopstarter');

  // Allow iframes from:
  // o YouTube.com
  // o Vimeo.com
  $config->set('HTML.SafeIframe', true);
  $config->set('URI.SafeIframeRegexp', '%^http://(www.youtube(?:-nocookie)?.com/embed/|player.vimeo.com/video/)%');

  $config->set('HTML.Allowed', implode(',', $allowed));

  // Set some HTML5 properties
  $config->set('HTML.DefinitionID', 'html5-definitions'); // unqiue id
  $config->set('HTML.DefinitionRev', 1);

  if ($def = $config->maybeGetRawHTMLDefinition()) {
    // http://developers.whatwg.org/sections.html
    $def->addElement('section', 'Block', 'Flow', 'Common');
    $def->addElement('nav',     'Block', 'Flow', 'Common');
    $def->addElement('article', 'Block', 'Flow', 'Common');
    $def->addElement('aside',   'Block', 'Flow', 'Common');
    $def->addElement('header',  'Block', 'Flow', 'Common');
    $def->addElement('footer',  'Block', 'Flow', 'Common');

    // Content model actually excludes several tags, not modelled here
    $def->addElement('address', 'Block', 'Flow', 'Common');
    $def->addElement('hgroup', 'Block', 'Required: h1 | h2 | h3 | h4 | h5 | h6', 'Common');

    // http://developers.whatwg.org/grouping-content.html
    $def->addElement('figure', 'Block', 'Optional: (figcaption, Flow) | (Flow, figcaption) | Flow', 'Common');
    $def->addElement('figcaption', 'Inline', 'Flow', 'Common');

    // http://developers.whatwg.org/the-video-element.html#the-video-element
    $def->addElement('video', 'Block', 'Optional: (source, Flow) | (Flow, source) | Flow', 'Common', array(
      'src' => 'URI',
      'type' => 'Text',
      'width' => 'Length',
      'height' => 'Length',
      'poster' => 'URI',
      'preload' => 'Bool',
      'controls' => 'Bool',
    ));
    $def->addElement('source', 'Block', 'Flow', 'Common', array(
      'src' => 'URI',
      'type' => 'Text',
    ));

    // http://developers.whatwg.org/text-level-semantics.html
    $def->addElement('s',    'Inline', 'Inline', 'Common');
    $def->addElement('var',  'Inline', 'Inline', 'Common');
    $def->addElement('sub',  'Inline', 'Inline', 'Common');
    $def->addElement('sup',  'Inline', 'Inline', 'Common');
    $def->addElement('mark', 'Inline', 'Inline', 'Common');
    $def->addElement('wbr',  'Inline', 'Empty', 'Core');

    // http://developers.whatwg.org/edits.html
    $def->addElement('ins', 'Block', 'Flow', 'Common', array('cite' => 'URI', 'datetime' => 'CDATA'));
    $def->addElement('del', 'Block', 'Flow', 'Common', array('cite' => 'URI', 'datetime' => 'CDATA'));

    // TinyMCE
    $def->addAttribute('img', 'data-mce-src', 'Text');
    $def->addAttribute('img', 'data-mce-json', 'Text');

    // Others
    $def->addAttribute('iframe', 'allowfullscreen', 'Bool');
    $def->addAttribute('table', 'height', 'Text');
    $def->addAttribute('td', 'border', 'Text');
    $def->addAttribute('th', 'border', 'Text');
    $def->addAttribute('tr', 'width', 'Text');
    $def->addAttribute('tr', 'height', 'Text');
    $def->addAttribute('tr', 'border', 'Text');
  }

  return new HTMLPurifier($config);
}

