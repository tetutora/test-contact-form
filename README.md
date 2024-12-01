Dockerビルド
  1.https://github.com/tetutora/test-contact-form
  2.docker-compose up -d --buld
※MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。

Laravel環境構築
  1.docker-compose exec php bash
  2.composer install
  3..env.exampleファイルから.envを作成し環境変数を変更
  4.php artisan key:generate
  5.php artisan migrate
  6.php artisan db:seed

