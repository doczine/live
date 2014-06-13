#/usr/bin/bash
cp /var/log/httpd-access.log /usr/home/capstone/httpd-access.log
awk '/q=/,/&/' /usr/home/capstone/httpd-access.log > /usr/home/capstone/search-terms.txt
php -f /usr/local/www/apache22/data/regex_between.php