<html>
  <body>
    <div id="container">
      <h1>Cognito Callback Page</h1>
<?php
    echo '<h2>Authentication Codeが取得できました！</h2>';

    // Cognitoに送るPOSTリクエストのボディ情報
    $data = array(
        'code' => $_GET['code'],
        'client_id' => getenv('COGNITO_CLIENT_ID'),
        'grant_type' => 'authorization_code',
        'redirect_uri' => getenv('COGNITO_CALLBACK_URL'),
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
                        'Content-Type: application/x-www-form-urlencoded',
                    ),
                    'content' => http_build_query($data),
                ),
            )
        )
    );

    if ($jwtJsonText) {
        echo '<h2>Authentication CodeをつかってID Tokenが取得できました！</h2>';

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
                explode('.', $jwt['id_token'])[1],
                true
            )
        );
        echo '</pre>';
    }
?>

      <button onclick="moveNextPage()">ID Tokenを使って認証必要ページにアクセスしてみます。</button>
      <script>
    function moveNextPage() {
      let idToken = "<?php if (isset($jwt['id_token'])) echo $jwt['id_token']; ?>";

      document.location = "/check_id_token.php?id_token=" + idToken;
    }
      </script>
    </div>
  </body>
</html>
