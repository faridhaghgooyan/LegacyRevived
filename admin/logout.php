<script src="../assets/js/users.js"></script>

<script>
    let userID = $('#loggedUser').val();
    alert(userID);

    logOut(userID);
</script>
<?php
setcookie("TF-Email", "", time() - 3600);
header('location:login.php');
?>

<script>  window.location.replace("login.php"); </script>