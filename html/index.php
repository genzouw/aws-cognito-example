<html>
  <body>
    <div id="container">
      <h1>Cognito OAuth2 Page</h1>

      <h2>Start OAuth2</h2>

      <ul>
<?php
// 設定が必要な環境変数名の一覧
$envVarNames = array(
    'COGNITO_DOMAIN',
    'COGNITO_REGION_ID',
    'COGNITO_USERPOOL_ID',
    'COGNITO_CLIENT_ID',
    'COGNITO_CALLBACK_URL',
    'COGNITO_RESPONSE_TYPE',
);

// 最低限必要な環境変数の設定が行われているかをチェック
foreach ($envVarNames as $name) {
    if (!getenv($name)) {
        echo "<li><strong style=\"color:red\">\"${name}\" is not defined.</strong></li>";
    }
}
?>
      </ul>

      <ul>
        <li>
          <strong>
            <a href="https://<?php echo getenv('COGNITO_DOMAIN'); ?>.auth.<?php echo getenv('COGNITO_REGION_ID'); ?>.amazoncognito.com/login?response_type=<?php echo getenv('COGNITO_RESPONSE_TYPE'); ?>&client_id=<?php echo getenv('COGNITO_CLIENT_ID'); ?>&redirect_uri=<?php echo getenv('COGNITO_CALLBACK_URL'); ?>">LOGIN!</a>
          </strong>
        </li>
      </ul>
    </div>
  </body>
</html>
