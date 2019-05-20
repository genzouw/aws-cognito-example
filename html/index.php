<html>
  <body>
    <div id="container">
      <h1>Cognito OAuth2 Page</h1>

      <h2>Start OAuth2</h2>

      <ul>
        <li>
          <strong>
            <a href="https://<?php echo getenv('COGNITO_DOMAIN'); ?>.auth.<?php echo getenv('COGNITO_REGION_ID'); ?>.amazoncognito.com/login?response_type=token&client_id=<?php echo getenv('COGNITO_CLIENT_ID'); ?>&redirect_uri=http://localhost:8080/callback.php">LOGIN!</a>
          </strong>
        </li>
      </ul>
    </div>
  </body>
</html>
