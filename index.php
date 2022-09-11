<?php include 'inc/header.php'; ?>

<?php
$name = $email = $body = '';
$nameErr = $emailErr = $bodyErr = '';

// form submit
if (isset($_POST['submit'])) {
  //name
  if (empty($_POST['name'])) {
    $nameErr = 'お名前をご入力ください';
  } else {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  //email
  if (empty($_POST['email'])) {
    $emailErr = 'メールアドレスをご入力ください';
  } else {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  }

  // comment
  if (empty($_POST['body'])) {
    $bodyErr = 'コメントをご入力ください';
  } else {
    $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }


  if (empty($nameErr) && empty($emailErr) && empty($bodyErr)) {
    // add to database
    $sql = "INSERT INTO feedback (name, email, body) VALUES ('$name','$email','$body')";
    if (mysqli_query($conn, $sql)) {
      // success
      header('Location:feedback.php');
    } else {
      // error
      echo 'エラー：' . mysqli_error($conn);
    }
  }
}

?>




<h2>コメント欄</h2>
<p class="lead text-center">良かったらコメントしてみてください</p>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method='POST' class="mt-4 w-75">
  <div class="mb-3">
    <label for="name" class="form-label">お名前</label>
    <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null ?>" id="name" name="name" placeholder="お名前をご入力ください">
    <div class="invalid-feedback">
      <?php echo $nameErr; ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">メールアドレス</label>
    <input type="email" class="form-control <?php echo $emailErr ? 'is-invalid' : null ?>" id="email" name="email" placeholder="メールアドレスをご入力ください">
    <div class="invalid-feedback">
      <?php echo $emailErr; ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="body" class="form-label">コメント</label>
    <textarea class="form-control <?php echo $bodyErr ? 'is-invalid' : null ?>" id="body" name="body" placeholder="コメントをご入力ください"></textarea>
    <div class="invalid-feedback">
      <?php echo $bodyErr; ?>
    </div>
  </div>
  <div class="mb-3">
    <input type="submit" name="submit" value="送信する" class="btn btn-dark w-100">
  </div>
</form>
<?php include 'inc/footer.php'; ?>