#! /bin/bash

#make year, month, day, hour, minutes, second sql file
#touch Full_$(date +'%Y-%m-%d_%H:%m:%S').sql

if Full_$(date +'%Y-%m-%d').sql -f /home/soaa/www/backup/
then
	mysqldump -usoaa -p2013 soaa > Full_$(date +'%Y-%m-%d').sql

else
	touch Full_$(date +'%Y-%m-%d').sql
	mysqldump -usoaa -p2013 soaa > Full_$(date +'%Y-%m-%d').sql
fi