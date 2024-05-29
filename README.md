# dev-docker
Dockerでa-blog cmsを動かします
## ioncube loaderを利用する場合
```docker compose up``` の前に以下の　コマンドでlinux/and64のmysqlのイメージをpullします。
```
docker image pull --platform linux/amd64 mysql:5.7.40
```
