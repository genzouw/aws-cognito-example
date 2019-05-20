<html>
  <body>
    <div id="container">
      <h1>Cognito Callback Page</h1>

      <h2>Get AccessToken(JWT)</h2>

      <div id="access_token"></div>

      <div>
        <button id="submit-access-token">AccessTokenをサーバに送信</button>
      </div>

      <hr>

      <h2>Http Request</h2>
      <pre>
<?php
var_dump($_SERVER);
var_dump($_REQUEST);
?>
      </pre>
    </div>
    <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"></script>
    <script>
$(function() {
  let fragment = document.location.href.replace(/^.*#/mgi, "");
  let accessToken = fragment.split("&").find((text) => text.indexOf("access_token") === 0).replace(/^access_token=/mgi, "")
  console.log(accessToken)
  $("#access_token").html(accessToken)

  // console.log(fragment)
  console.log("OK")

  $("#submit-access-token").on("click", function(e) {
    document.location = `//cognito.genzouw.com/check_access_token.php?access_token=${accessToken}`
  })
})
    </script>
  </body>
</html>
