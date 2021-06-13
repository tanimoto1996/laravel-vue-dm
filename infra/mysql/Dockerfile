FROM mysql/mysql-server:8.0

ENV MYSQL_DATABASE=laravel_vue_dm \
  MYSQL_USER=tanimoto \
  MYSQL_PASSWORD=kakaka \
  MYSQL_ROOT_PASSWORD=kakaka \
  TZ=Asia/Tokyo

COPY ./my.cnf /etc/my.cnf
RUN chmod 644 /etc/my.cnf