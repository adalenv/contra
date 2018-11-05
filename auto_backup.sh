rsync --ignore-existing  /var/www/html/application/audios/* /backup/audios ;
rsync --ignore-existing  /var/www/html/application/documents/* /backup/documents ;
/usr/bin/mysqldump  -pAdmin2018  justcall > /backup/database/justcall.backup_$(date +%Y%m%d).sql ; 
echo 'Backup success!';
