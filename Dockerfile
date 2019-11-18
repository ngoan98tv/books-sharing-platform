FROM linuxconfig/lamp

RUN service mysql start; mysqladmin -uadmin -ppass create books

ADD 000-default.conf /etc/apache2/sites-available/

RUN a2enmod rewrite && service apache2 restart

EXPOSE 80

CMD ["supervisord"]