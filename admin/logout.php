<?php
    session_start();
    session_destroy();  // Correct spelling
    // session_unset(); // Optional (you can use this too, but destroy() is enough)
?>

<script>
    location.assign("../index.php");
</script>
