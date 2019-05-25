<html>
  <body>
    <div id="container">
      <h1>Cognito Callback Page</h1>
<?php
if (getenv('COGNITO_RESPONSE_TYPE') === 'token') {
    echo '
      <h2>access_type=codeで認証手続きが行われました。</h2>

      <em>自動的に遷移します...</em>

      <script>
        // URLからフラグメント、つまり `#` より後ろの部分を取り出す
        let fragment = document.location.href.replace(/^.*#/mgi, "");
        // フラグメントから "id_token=~" の部分を取り出す
        let idToken = fragment.split("&").find((text) => text.indexOf("id_token") === 0).replace(/^id_token=/mgi, "")

        document.location = `/check_id_token.php?id_token=${idToken}`
      </script>
    ';
} else {
    echo '<h2>access_type=codeで認証手続きが行われました。</h2>';

    // Cognitoに送るPOSTリクエストのボディ情報
    $data = array(
        'code' => $_GET['code'],
        'client_id' => getenv('COGNITO_CLIENT_ID'),
        'grant_type' => 'authorization_code',
        'redirect_uri' => getenv('COGNITO_CALLBACK_URL'),
        'client_secret' => getenv('COGNITO_CLIENT_SECRET'),
    );

    // Cognitoに送るPOSTリクエストのURL
    $url = 'https://' . getenv('COGNITO_DOMAIN') . '.auth.' . getenv('COGNITO_REGION_ID') . '.amazoncognito.com/oauth2/token';

    // CognitoにPOSTリクエストを送信し、レスポンスJSONテキスト情報を取得
    $jwtJsonText = file_get_contents(
        $url,
        false,
        stream_context_create(
            array(
                'http' => array(
                    'method' => 'POST',
                    'header' => array(
                        "Content-Type: application/x-www-form-urlencoded",
                    ),
                    'content' => http_build_query($data),
                ),
            )
        )
    );

    if ($jwtJsonText) {
        // ブラウザに"ID Token"を渡さずに、JavaScriptを使わずに認証が完了する
        $jwt = (array) json_decode($jwtJsonText);

        echo '<h3>ID Token</h3>';
        echo '<pre>';
        var_dump($jwt['id_token']);
        echo '</pre>';

        // ID Tokenをカンマ(".")で区切って2番目の要素にemailアドレス情報が付与されている
        echo '<h3>ID Token(base64 decoded)</h3>';
        echo '<pre>';
        var_dump(
            base64_decode(
                explode('.', $jwt['id_token'])[1]
            )
        );
        echo '</pre>';
    }
}
?>
    </div>
  </body>
</html>
