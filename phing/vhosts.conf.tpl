<VirtualHost *:80>
    DocumentRoot "${apache.domain.path}/public_html"
    ServerName ${apache.domain.name}
    ErrorLog "${apache.domain.path}/log/error.log"
    CustomLog "${apache.domain.path}/log/access.log" combined

    <Directory "${apache.domain.path}/public_html">
      DirectoryIndex index.php
      Options Indexes MultiViews FollowSymLinks
      AllowOverride All
      Order allow,deny
      Allow from all
    </Directory>
</VirtualHost>