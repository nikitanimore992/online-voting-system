<?php
require_once(__DIR__ . "/../../admin/inc/config.php");

if (isset($_POST['e_id']) && isset($_POST['c_id']) && isset($_POST['v_id'])) {

    $election_id = mysqli_real_escape_string($db, $_POST['e_id']);
    $candidate_id = mysqli_real_escape_string($db, $_POST['c_id']);
    $voter_id = mysqli_real_escape_string($db, $_POST['v_id']);
    $vote_date = date("Y-m-d");
    $vote_time = date("h:i:s a");

    // Check if voter already voted in this election
    $alreadyVoted = mysqli_query($db, "SELECT * FROM votings WHERE voters_id='$voter_id' AND election_id='$election_id'");
    if (mysqli_num_rows($alreadyVoted) > 0) {
        echo "already_voted";
        exit;
    }

    // Insert new vote
    $query = "INSERT INTO votings (election_id, voters_id, candidate_id, vote_date, vote_time)
              VALUES ('$election_id', '$voter_id', '$candidate_id', '$vote_date', '$vote_time')";

    if (mysqli_query($db, $query)) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "invalid_request";
}
?>
