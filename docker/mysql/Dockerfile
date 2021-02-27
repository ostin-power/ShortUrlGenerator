FROM mysql

COPY my.cnf /etc/mysql/my.cnf
RUN mkdir /etc/mysql/mysql.conf.d
RUN rm -rf /var/lib/apt/lists/*

RUN mkdir /var/lib/mysql-files

#COPY init.sql /tmp/init.sql
#RUN mysql -u"root" "-ppassword" "short_url_db" < "/tmp/init.sql"
