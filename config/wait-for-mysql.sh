#!/bin/bash
# wait-for-mysql.sh

set -e

host="$1"
shift
cmd="$@"

until mysql -h "$host" -u "notes_app_user" -pJGx05CWMKBmCWit7xfZjbrkYlMwX1b2F -e 'show databases'; do
  >&2 echo "MySQL is unavailable - sleeping"
  sleep 1
done

>&2 echo "MySQL is up - executing command"
exec $cmd




#until mysql -hsstest_mysql -unotes_app_user -pJGx05CWMKBmCWit7xfZjbrkYlMwX1b2F -e "show databases"; do
#  >&2 echo "Postgres is unavailable - sleeping"
#  sleep 1
#done

#>&2 echo "Postgres is up - executing command"
#exec $cmd
