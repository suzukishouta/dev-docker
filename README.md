# Dockerでa-blog cmsを動かします
## 01.　事前準備
バージョン違いのMySqlを起動しますのでボリュームを2種類作ります。  
```
docker volume create --name mysql80
```
```
docker volume create --name mysql57
```
ネットワークを作ります。
```
docker network create shark
```
```shark```の部分は自分の好きなものに変更してください。また、各フォルダ内のcompose.yamlのネットワーク名の```shark```も全て変更してください。
## 02.　バックエンド用のコンテナを作成
proxyフォルダとmysqlフォルダに移動してコンテナを作成します
```
docker compose up --detach
```
ここで作ったコンテナは毎回使うので作業後も削除しない運用をおすすめします。
## 03. a-blog cms用のコンテナを作成
ver.3.0以降の場合はacms_latestフォルダを任意のフォルダ名に変更して使用します。
ver.2.11以前の場合はacms_pastフォルダを任意のフォルダ名に変更して使用します。
### hostsを追加する
compose.yamlに```VIRTUAL_HOST```という環境変数が設定されています。
```
services:
  www:
    image: atsu666/acms:8.3
    privileged: true
    environment:
      - APACHE_DOCUMENT_ROOT=/var/www/html
      - VIRTUAL_HOST=sample.localhost,www.sample.localhost
以下略
```
ブラウザでsample.localhostを表示させるとローカルを見に行くようにhostsファイルに追加します。
```
127.0.0.1 sample.localhost
127.0.0.1 www.sample.localhost
```
VIRTUAL_HOSTで設定したURLにアクセスするとproxyコンテナで表示を振り分けてくれるので複数のa-blogのコンテナを同時に立ち上げることができます。
その際はhostsに随時URLを追加してください。
```
127.0.0.1 sample01.localhost
127.0.0.1 www.sample01.localhost
127.0.0.1 sample02.localhost
127.0.0.1 www.sample02.localhost
```
hostsファイルの編集ができたらフォルダに移動したら下記のコマンドでコンテナを作成します。
```
docker compose up --detach
```
こちらのコンテナはPC内のどこでも立ち上げることができますので、好きな場所にフォルダを移動して使用できます。
