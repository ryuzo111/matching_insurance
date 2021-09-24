## ほけんとーく
保険の悩み共有アプリ「ほけんとーく」です。</br>
保険に対する悩みを投稿することで、様々なユーザーからアドバイスをいただき解決のヒントとなるWEBアプリです。</br>
また、悩み投稿とコメントを共有することで、他のユーザーの悩み解決のヒントとなります。多くの人に見られたくない悩みは2人だけのチャット機能で相談することができます。</br>

このアプリを通して目指すものは、ユーザーが保険の悩みを共有して①解決のヒントや、②安心感、③考えるきっかけ　以上のようなものを得るためです。</br>
（直接保険営業マンとマッチングすることや、WEB上で保険の成立を目的とはしない）


## 開発のきっかけ

発案者が保険会社で代理店営業を行なっていた際の経験をもとに、以下の理由でサービスの開発に至りました。</br>
①保険に興味はあるけど、ほけんの窓口だと無理な保険を勧められそうで不安。</br>
②保険加入者の多くは会社の利益を優先する営業マンより、利益を求めない知人に勧められることがきっかけ。</br>
③営業マンではなく、一般の人が保険に対して意見交換する場がない。</br>
④世に似たサービスがなかった。</br>


## 開発メンバー

バックエンド3名　</br>
フロントエンド1名

## 使用技術/使用ツール

php7/Laravel5.5
HTML5/CSS/Bootstrap/javascript</br>
mysql </br>
git/GitHub/Linux </br> 
slack/trello/調整くん/diagrams </br>

## ER図
![ER図](https://github.com/ryuzo111/matching_insurance/blob/master/ER.png)



## URL


[ほけんとーく](https://www.hoken-talk.net/) </br>
※WEBアプリのためインストール不要</br>
[Qita　解説記事](https://qiita.com/yagiryu/items/f86b505cc28fe55cc054) </br>

## 操作方法

### 全ユーザー共通（ログイン状況を問わない）　
①ホーム画面から悩み投稿の一覧を確認することができる。　</br>
![!](https://github.com/ryuzo111/matching_insurance/blob/master/storage/app/public/default/1readme.png)
②投稿一覧ページから投稿をクリックしていただくと、悩み投稿に対する解決の提案を確認することができる。　</br>
![!](https://github.com/ryuzo111/matching_insurance/blob/master/storage/app/public/default/2readme.png)
③ユーザー名をクリックしていただくとプロフィールページに遷移して、ユーザー情報を確認することができる。　</br>
![!](https://github.com/ryuzo111/matching_insurance/blob/master/storage/app/public/default/3readme.png)
④メニューバーからランキングページに遷移して、週間提案コメントランキングと、週間ユーザーランキング（どちらもコメントに対するいいねの数による）　</br>
⑤お問い合わせページから運営に問い合わせることができる。</br>
![!](https://github.com/ryuzo111/matching_insurance/blob/master/storage/app/public/default/4readme.png)
⑥禁止事項ページに遷移して禁止事項の一覧を見ることができる。</br>

### ログインユーザーのみ　
①悩み投稿ページに遷移し、悩み投稿を行える。（削除と編集も可）　</br>
![!](https://github.com/ryuzo111/matching_insurance/blob/master/storage/app/public/default/5readme.png)
②ログインユーザーのプロフィールページにてプロフィールを編集することができる。　</br>
![!](https://github.com/ryuzo111/matching_insurance/blob/master/storage/app/public/default/6readme.png)
③他ユーザーのプロフィールページからフォローとフォロー解除することができる。　</br>
④各ユーザーのプロフィールページからフォロー一覧ページに遷移することができる。　</br>
⑤各ユーザーのプロフィールページからフォロワー一覧ページに遷移することができる。　</br>
![!](https://github.com/ryuzo111/matching_insurance/blob/master/storage/app/public/default/7readme.png)
⑥他ユーザーのプロフィールページからチャットページに遷移し、個人チャットすることができる。（1度チャットを行ったユーザーはチャット相手選択ページに表示されます）　</br>
![!](https://github.com/ryuzo111/matching_insurance/blob/master/storage/app/public/default/8readme.png)
⑦悩み投稿に対してコメントをすることができる。(削除と編集も可）　</br>
⑧コメントに対して「いいね」をすることができる。　</br>
![!](https://github.com/ryuzo111/matching_insurance/blob/master/storage/app/public/default/9readme.png)
⑨フォロー者の投稿とコメントを一覧で見ることができる。</br>
![!](https://github.com/ryuzo111/matching_insurance/blob/master/storage/app/public/default/10readme.png)
⑩パスワードを変更できる。</br>
⑪プロフィールページから家族が加入している保険の情報を追加できる。</br>
![!](https://github.com/ryuzo111/matching_insurance/blob/master/storage/app/public/default/11readme.png)

　※ご不明点はメニューバーから遷移できるお問い合わせページからお願い致します。　</br>
　※禁止事項を必ずご確認いただいた上でのご利用をお願いいたします。</br>

## ポイント

・悩み投稿の投稿内容が意図した解答を得られるような設問項目を設定　</br>
ファイナンシャルプランナー（FP）やライフプランアドバイザー（LPA）が保険の提案、家計の見直しをする際に、ユーザーに多くの質問をして情報を聞き出し、その情報をもとに個人ごとに最適なプラン設計をいたします。　</br>
本アプリでもユーザーの悩みが解決できるように、投稿時に多くのFP、LPAが知りたい内容を盛り込めるような設計にいたしました。　</br>

・保険の内容に特化したプロフィール機能　</br>
悩み投稿からだけでなく、ユーザーの悩みの背景を提案者が汲み取れるようにするため　</br>

## 今後の計画

・非同期通信</br>
・使っていただくユーザーを増やす　</br>
・ランキング機能のパターンを増やす（月間ユーザー、月間コメント）　</br>
・WEBサイト上にLPAなどの保険のプロによるブログページを用意する　</br>
・pwa化　</br>
・スマホアプリ化　</br>
・チャット機能の改修　</br>

