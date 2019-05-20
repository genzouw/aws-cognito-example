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
    // We load the key set from an URL
    $cognitoClientId = 'ap-northeast-1_Qr5Ow2KHj';
    $cognitoRegionId = 'ap-northeast-1';
    $jku = "https://cognito-idp.{$cognitoRegionId}.amazonaws.com/{$cognitoClientId}/.well-known/jwks.json";
    $jwk = JWKFactory::createFromJKU($jku);

    $loader = new Loader();

    $idToken = $_GET['id_token'];

    // The signature is verified using our key set.
    $jws = $loader->loadAndVerifySignatureUsingKeySet(
        $idToken,
        $jwk,
        ['RS256'],
        $signatureIndex
    );

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

