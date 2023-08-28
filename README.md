## 構造

- バックエンドはcalendar-backendをXamppでWebサーバ起動
    - SFTPでkiriにアップ
- フロントエンドはcalendar-reservationでcreate-react-appのサーバー起動
    - バックエンドサーバーをproxyとして経由
    - SFTPでkiriにアップ

バックエンドもフロントエンドもそのままのフォルダ構造でkiriにアップされれば
kiri上でアプリが動く
※ローカルでは2つのプロジェクト。kiriでは1つのプロジェクト。

## proxy server設定手順

1. 2 separate directories of back-end and front-end
2. create web-server
    - front-end
        - by create-react-app
    - back-end
        - by xampp or the unique with express
3. set proxy and designate back-end URL there in package.json
    - `"proxy": "http://calendar-backend:8080/",`
4. if xampp, consider PHP version
4. if xampp and back-end language is PHP, edit `upload_tmp_dir` and `session.save_path` from `\xampp\tmp` to `c:\xampp\tmp` in php.ini