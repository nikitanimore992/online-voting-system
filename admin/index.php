<?php
    require_once ("inc/header.php");
    require_once ("inc/navigation.php");  


    if (isset($_GET['homepage'])) {
        // echo "<br><h3 class='text-center text-green'>Admin Home Page</h3><br>";
        require_once ("inc/homepage.php");
    } else if (isset($_GET['addElectionPage'])) {
        // echo "<br><h3 class='text-center text-green'>Add Election Page</h3><br>";
        require_once ("inc/add_elections.php");
    }else if (isset($_GET['addCandidatePage'])) {
        // echo "<br><h3 class='text-center text-green'>Add Candidate Page</h3><br>";
        require_once ("inc/add_candidates.php");
    }
?>


<?php
     require_once ("inc/footer.php");
?>
