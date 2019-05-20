<html>
  <body>
    <div id="container">
      <h1>Cognito Callback Page</h1>

      <h2>Get IdToken(JWT)</h2>

      <div id="id_token"></div>

      <div>
        <button id="submit-id-token">IdTokenをサーバに送信</button>
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
  let idToken = fragment.split("&").find((text) => text.indexOf("id_token") === 0).replace(/^id_token=/mgi, "")
  console.log(idToken)
  $("#id_token").html(idToken)

  // console.log(fragment)
  console.log("OK")

  $("#submit-id-token").on("click", function(e) {
    document.location = `//cognito.genzouw.com/check_id_token.php?id_token=${idToken}`
  })
})
    </script>
  </body>
</html>
