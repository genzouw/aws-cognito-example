<html>
  <body>
    <div id="container">
      <h1>Cognito Callback Page</h1>

      <h2>Check AccessToken(JWT)</h2>

      <div id="access_token">
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Jose\Factory\JWKFactory;
use Jose\Loader;

try {
    // We load the key set from an URL

    $jku = 'https://cognito-idp.ap-northeast-1.amazonaws.com/ap-southeast-2_EPyUfpQq7/.well-known/jwks.json';
    $jwk_set = JWKFactory::createFromJKU($jku);

    // We create our loader.
    $loader = new Loader();

    // This is the input we want to load verify.
    $input = $_GET['access_token'];

    // The signature is verified using our key set.
    $jws = $loader->loadAndVerifySignatureUsingKeySet(
    $input,
    $jwk_set,
    ['RS256'],
    $signature_index
);

    echo '<strong style="color: green;">OK!</strong>';
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

