<html>
  <body>
    <div id="container">
      <h1>Cognito Callback Page</h1>

      <h2>Check IdToken(JWT)</h2>

      <div id="id_token">
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Jose\Factory\JWKFactory;
use Jose\Loader;

try {
    $cognitoRegionId = getenv('COGNITO_REGION_ID');
    $cognitoUserpoolId = getenv('COGNITO_USERPOOL_ID');

    // 公開鍵を取得
    $jku = "https://cognito-idp.{$cognitoRegionId}.amazonaws.com/{$cognitoUserpoolId}/.well-known/jwks.json";
    $jwk = JWKFactory::createFromJKU($jku);

    // 「ID Token」を取得
    $idToken = $_GET['id_token'];

    // 「ID Token」の妥当性をチェック。問題があれば例外発生
    $loader = new Loader();
    $jws = $loader->loadAndVerifySignatureUsingKeySet(
        $idToken,
        $jwk,
        ['RS256'],
        $signatureIndex
    );

    $expire = $jws->getPayload()['exp'];
    $current = time();

    // ID Tokenの有効期限切れチェック
    if ($expire < $current) {
        throw new Exception("ID Token has expired. ");
    }

    echo '<strong style="color: green;">OK!</strong>';
    echo '<pre>';
    echo "email = {$jws->getPayload()['email']}";
    echo '</pre>';
} catch (Exception $e) {
    echo '<strong style="color: red;">NG!</strong>';
    echo '<pre>';
    var_dump($e);
    echo '</pre>';
}
?>
      </div>
  </body>
</html>

