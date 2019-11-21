FROM linuxconfig/lamp

RUN service mysql start; mysqladmin -uadmin -ppass create books;

ADD database/books.sql /home/

# RUN mysql -uadmin -ppass books < /home/books.sql

ADD 000-default.conf /etc/apache2/sites-available/

RUN a2enmod rewrite && phpenmod pdo_mysql && service apache2 restart

EXPOSE 80

CMD ["supervisord"]