#!/bin/bash
MYSQL_USER=admin
MYSQL_PASSWORD=password

mysql -u$MYSQL_USER -p$MYSQL_PASSWORD < /docker-entrypoint-initdb.d/init.sql

# find $CODE_DIR -type f  -name '*.sql' -print0 | while IFS= read -r -d '' file; do
# 	mysql -uroot -hlocalhost -p$(printenv MYSQL_ROOT_PASSWORD) < "$file"
# done
