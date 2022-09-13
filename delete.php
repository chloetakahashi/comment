

<?php

include 'config/database.php';


if (isset($_GET['id'])) {

    $user_id = $_GET['id'];

    $sql = "DELETE FROM feedback WHERE id='$user_id'";

    $result = $conn->query($sql);

    if ($result == TRUE) {

        // echo "コメントが削除されました。";
        header('location:feedback.php');
    } else {

        echo "エラー:" . $sql . "<br>" . $conn->error;
    }
}

?>

