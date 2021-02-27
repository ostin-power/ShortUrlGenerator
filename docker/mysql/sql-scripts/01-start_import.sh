#!/bin/bash
MYSQL_USER=root
MYSQL_PASSWORD=password

mysql -u$MYSQL_USER -p$MYSQL_PASSWORD < init.sql


# find $CODE_DIR -type f  -name '*.sql' -print0 | while IFS= read -r -d '' file; do
# 	mysql -uroot -hlocalhost -p$(printenv MYSQL_ROOT_PASSWORD) < "$file"
# done
