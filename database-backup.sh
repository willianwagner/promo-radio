#!/bin/bash
# sh database-backup.sh

  echo "fazendo cópia local do banco de dados\n"

  # Imports database list file
  . .env

  host=${DB_HOST}
  user=${DB_USER}
  db_name=${DATABASE}
  password=${DB_PASS}

  rm -r database_askh3da67sm8le2ei

  mkdir database_askh3da67sm8le2ei

  mysqldump --column-statistics=0 --user=$user --password=$password --host=$host $db_name > database_askh3da67sm8le2ei/$db_name.sql

  echo ".sql gerado com sucesso, fim do script.\n"