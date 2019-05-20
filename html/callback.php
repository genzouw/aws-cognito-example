<html>
  <body>
    <div id="container">
      <h1>Cognito Callback Page</h1>

      <em>自動的に遷移します...</em>
    </div>
    <script>
      // URLからフラグメント、つまり `#` より後ろの部分を取り出す
      let fragment = document.location.href.replace(/^.*#/mgi, "");
      // フラグメントから "id_token=~" の部分を取り出す
      let idToken = fragment.split("&").find((text) => text.indexOf("id_token") === 0).replace(/^id_token=/mgi, "")

      document.location = `/check_id_token.php?id_token=${idToken}`
    </script>
  </body>
</html>
