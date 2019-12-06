FROM linuxconfig/lamp

ADD database/books_sample_data.sql /home/

RUN service mysql start \
    && mysqladmin -uadmin -ppass create books \
    && mysql -uadmin -ppass books < /home/books_sample_data.sql

ADD 000-default.conf /etc/apache2/sites-available/

RUN a2enmod rewrite && phpenmod pdo_mysql && service apache2 restart

EXPOSE 80

CMD supervisord