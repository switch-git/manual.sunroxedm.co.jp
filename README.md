# マニュアル
https://manual.sunroxedm.co.jp.webservice-dev.com

### Basic認証
| ID | パスワード |
| ------------- | ------------- |
| switch | switch |

### 管理画面
https://manual.sunroxedm.co.jp.webservice-dev.com/

| メールアドレス | パスワード | 
|---------|-------|
| xxxx    | xxxxx |

※仮で設置しています。

***

### FTPのディレクトリ

サーバー移行後に記入します

***

### Git
https://github.com/switch-git/manual.sunroxedm.co.jp.git

***

### deploy
https://switch:switch@manual.sunroxedm.co.jp.webservice-dev.com/deploy/git_deploy.php

***

### Dockerを使う場合
http://127.0.0.1:8468/

```
cp -r ./env/ ./
cd docker
docker compose up -d
```

### MySQL(Dockerを使う場合)
| データベース | ユーザー | パスワード | ホスト              | ポート              |
|--------|--------| ------------- |------------------|------------------|
| sunroxedm_manual_db | sunroxedm_manual | sunroxedm_manual | mysql | 3306 |

※ローカルは127.0.0.1:2468

### 管理画面
http://127.0.0.1:8468/

| メールアドレス | パスワード | 
|---------|-------|
| xxxx    | xxxxx |