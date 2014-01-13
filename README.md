php-htmlpurifier-html5
======================

Load HTMLPurifier with support for:

* HTML5
* TinyMCE
* YouTube
* Video

How to use
======================

If you already have a GIT repo for your server, then:

    git submodule add https://github.com/kennberg/php-htmlpurifier-html5 php-htmlpurifier-html5
    git submodule init

Or, for installation inside your server directory:

    git clone https://github.com/kennberg/php-htmlpurifier-html5

Finally, view the example.php file to see how it works.

Make sure you define LIB\_DIR so HTML purifier can be loaded. With default LIB\_DIR path is: ROOT/lib/third-party/htmlpurifier/. See example.php to how to set this up.

More info
======================

HTMLPurifier: http://htmlpurifier.org/

Contributions: Propose each change via issues, then fork, implement and send a pull request.

License
======================
Apache v2. See the LICENSE file.
