#!/bin/bash
# sh database-restore.sh

  echo "restaurando banco de dados\n"

  # Imports database list file
  . .env

  host=${DB_HOST}
  user=${DB_USERNAME}
  db_name=${DB_DATABASE}
  password=${DB_PASSWORD}

  mysql -u${user} -p${password} -e "CREATE DATABASE $db_name"
  mysql -u${user} -p${password} $db_name < database_askh3da67sm8le2ei/$db_name.sql

  echo ".sql importado com sucesso, fim do script.\n"