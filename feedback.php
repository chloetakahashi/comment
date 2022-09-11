<?php include 'inc/header.php' ?>


<?php
$sql = 'SELECT * FROM feedback';
$result = mysqli_query($conn, $sql);
$feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>




<h2>コメント一覧</h2>

<?php if (empty($feedback)) : ?>
  <p class="lead mt-3">There is no feedback</p>
<?php endif; ?>


<?php foreach ($feedback as $item) : ?>
  <div class="card my-3 w-75">
    <div class="card-body text-center">
      <div class="mb-3"><?php echo $item['body']; ?></div>
      <div class="text-secondary mt-2 d-flex justify-content-around">
        <div class="">
          <?php echo $item['date']; ?></div>
        <div class=""><small>投稿者：</small><?php echo $item['name']; ?></div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<?php include 'inc/footer.php' ?>