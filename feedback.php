<?php include 'inc/header.php' ?>


<?php
$sql = 'SELECT * FROM feedback';
$result = mysqli_query($conn, $sql);
$feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>


<h2>コメント一覧</h2>

<?php if (empty($feedback)) : ?>
  <p class="lead mt-3">コメントがありません。新しいコメントしましょう。</p>
<?php endif; ?>

<?php if (!empty($feedback)) : ?>
  <h5 class="my-3">こちらでコメントを閲覧、編集または削除することができます。</h5>
<?php endif; ?>


<?php foreach ($feedback as $item) : ?>
  <div class="card my-3 w-75 d-flex">
    <div class="card-body text-center">
      <div class="text-secondary mt-2 mb-5 d-flex justify-content-around">
        <div class="">
          <?php echo $item['date']; ?></div>
        <div class=""><small>投稿者：</small><?php echo $item['name']; ?></div>
      </div>
      <div class="mb-3"><?php echo $item['body']; ?></div>
      <div class="button text-end">
        <button class="btn btn-primary"><a href="update.php?id=<?php echo $item['id']; ?>" class="text-light text-decoration-none">編集</a></button>
        <button class="btn btn-danger"><a href="delete.php?id=<?php echo $item['id']; ?>" class="text-light text-decoration-none">削除</a></button>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<a href="index.php" class="btn btn-secondary my-3">新しいコメントを追加する</a>

<?php include 'inc/footer.php' ?>