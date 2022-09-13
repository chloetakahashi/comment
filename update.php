<?php include 'inc/header.php'; ?>

<?php
$name = $email = $body = '';
$nameErr = $emailErr = $bodyErr = '';


// form edit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo $id;
    $sql = "SELECT * from feedback WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    while ($item = $result->fetch_assoc()) {
        if ($item['id'] == $_GET['id']) {
            $name = $item['name'];
            $email = $item['email'];
            $body = $item['body'];
            $id = $item['id'];
            // echo '<pre>';
            // var_dump($item);
            // echo '</pre>';
        }
    }
}




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
        include 'config/database.php';
        // add to database
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $body = $_POST['body'];
        $sql = "UPDATE feedback SET name='$name', email='$email', body='$body' WHERE id='$id'";
        $result = $conn->query($sql);
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




<h2>コメントを編集する</h2>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method='POST' class="mt-4 w-75">
    <div class="mb-3">
        <label for="name" class="form-label">お名前</label>
        <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null ?>" id="name" name="name" placeholder="お名前をご入力ください" value="<?php echo $name; ?>">
        <div class="invalid-feedback">
            <?php echo $nameErr; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">メールアドレス</label>
        <input type="email" class="form-control <?php echo $emailErr ? 'is-invalid' : null ?>" id="email" name="email" placeholder="メールアドレスをご入力ください" value="<?php echo $email; ?>">
        <div class="invalid-feedback">
            <?php echo $emailErr; ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">コメント</label>
        <textarea class="form-control <?php echo $bodyErr ? 'is-invalid' : null ?>" id="body" name="body" placeholder="コメントをご入力ください"><?php echo $body; ?></textarea>
        <div class="invalid-feedback">
            <?php echo $bodyErr; ?>
        </div>
    </div>
    <div class="mb-3">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="submit" name="submit" value="保存する" class="btn btn-dark w-100">
    </div>
</form>
<a href="feedback.php" class="btn btn-secondary w-75">取り消す</a>
<?php include 'inc/footer.php'; ?>