Tyler Sommer's Resume
=====================

My personal resume website, [tylersommer.pro](https://tylersommer.pro).

Copyright 2014-2022 Tyler Sommer. All rights reserved.


Overview
--------

This is a static site generated with PHP 7. Resume data stored in a validated XML format. 
Views are pre-rendered and rendered statically through any web server.


Usage
-----

0. Needs PHP and composer, node and grunt (`npm install -g grunt`)
1. Run `npm install` to install javascript dependencies.
2. Run `grunt server` to start a webserver on `http://localhost:3000`.

   This will install composer dependencies and run the built-in PHP webserver for local development.
3. (Optional) Run `grunt minify` to minify CSS and JS.

Rendered views are cached, and the cache must be cleared for changes in the XML data to appear in the site. Run 
`grunt cache` to clear the cache manually. Note, the cached is cleared automatically when `grunt server` runs.

CSS and JS are minified; run `grunt minify` for changes to raw scripts and styles to appear.


Deploying
---------

Due to the static nature of this website's content, running in production doesn't need to rely on PHP or anything 
except a webserver. The `build-cache.php` script will generate static HTML files in the `web/` directory and can 
be invoked with grunt or directly with php:

```bash
php build-cache.php
```

After that, nginx or another webserver can be configured to point `/` to index.html and `/print` to print.html. 

Example nginx configuration:

```
server {
    server_name tylersommer.pro;

    index index.html;

    location /print {
        try_files $uri /$uri.html;
    }
}
```
