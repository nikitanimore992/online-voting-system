<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
// include('./config.php'); // Example DB connection include

$election_id = mysqli_real_escape_string($db, $_GET['viewResult']);
?>

<div class="row my-3">
    <div class="col-12">
        <h3>Election Result</h3>    
<!-- ---------------------------------------------------------------------------- -->
 <?php
$fetchingActiveElections = mysqli_query($db, "SELECT * FROM elections WHERE id = '$election_id'") or die(mysqli_error($db));
$countActiveElections = mysqli_num_rows($fetchingActiveElections);

if ($countActiveElections > 0) {
    while ($data = mysqli_fetch_assoc($fetchingActiveElections)) {
        $fetching_id = $data['id'];
        $election_topic = $data['election_topic'];

        // ✅ Fetch candidates with their total votes in one optimized query
        $query = "
            SELECT c.*, COUNT(v.id) AS total_votes
            FROM candidate_details c
            LEFT JOIN votings v ON v.candidate_id = c.id AND v.election_id = '$fetching_id'
            WHERE c.election_id = '$fetching_id'
            GROUP BY c.id
            ORDER BY total_votes DESC
        ";
        $fetchingCandidates = mysqli_query($db, $query) or die(mysqli_error($db));

        // ✅ Determine highest vote count
        $maxVotes = 0;
        $candidates = [];
        while ($row = mysqli_fetch_assoc($fetchingCandidates)) {
            $row['total_votes'] = (int)$row['total_votes'];
            $candidates[] = $row;
            if ($row['total_votes'] > $maxVotes) {
                $maxVotes = $row['total_votes'];
            }
        }

        // ✅ If no votes at all
        if ($maxVotes == 0) {
            echo "<div class='alert alert-info my-3'>No votes have been cast yet for this election.</div>";
        }
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="5" class="bg-success text-white">
                        <h5>ELECTION TOPIC: <?php echo strtoupper($election_topic); ?></h5>
                    </th>
                </tr>
                <tr>
                    <th>S.No</th>
                    <!-- <th>Photo</th> -->
                    <th>Candidate Details</th>
                    <th># of Votes</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sno = 1;
                foreach ($candidates as $candidateData) {
                    // $candidate_photo = $candidateData['candidate_photo'];
                    $candidate_name = $candidateData['candidate_name'];
                    $candidate_details = $candidateData['candidate_details'];
                    $totalVotes = $candidateData['total_votes'];

                    // ✅ Fix image path
                    if (!empty($candidate_photo) && file_exists("../uploads/" . $candidate_photo)) {
                        $photoPath = "../uploads/" . $candidate_photo;
                    } else {
                        $photoPath = "../assets/images/default.png";
                    }

                    // ✅ Determine Winner / Loser
                    if ($maxVotes == 0) {
                        $resultLabel = "<span class='badge bg-secondary'>No Result</span>";
                    } elseif ($totalVotes == $maxVotes) {
                        $resultLabel = "<span class='badge bg-success'>Winner 🏆</span>";
                    } else {
                        $resultLabel = "<span class='badge bg-danger'>Loser</span>";
                    }
                    ?>
                    <tr>
                        <td><?php echo $sno++; ?></td>
                        <!-- <td>
                            <img src="<?php echo $photoPath; ?>" width="100" height="100"
                                 alt="Candidate Photo"
                                 onerror="this.src='../assets/images/'">
                        </td> -->
                        <td>
                            <b><?php echo htmlspecialchars($candidate_name); ?></b><br>
                            <?php echo htmlspecialchars($candidate_details); ?>
                        </td>
                        <td><?php echo $totalVotes; ?></td>
                        <td><?php echo $resultLabel; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }
} else {
    echo "<div class='alert alert-warning'>No active elections found.</div>";
}
?>

<!-- -------------------------------------------------------------------------------- -->
        

        <hr>
        <h3>Voting Details</h3>

        <?php
        $fetchingVotingDetails = mysqli_query($db, "SELECT * FROM votings WHERE election_id = '$election_id'") or die(mysqli_error($db));
        $number_of_votes = mysqli_num_rows($fetchingVotingDetails);

        if ($number_of_votes > 0) {
            $sno = 1;
        ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Voter Name</th>
                        <th>Contact No.</th>
                        <th>Voted To</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
        <?php
            while ($data = mysqli_fetch_assoc($fetchingVotingDetails)) {
                $voters_id = $data['voters_id'];
                $candidate_id = $data['candidate_id'];

                // Fetch Voter Data
                $fetchingUser = mysqli_query($db, "SELECT username, contact_no FROM userss WHERE id = '$voters_id'") or die(mysqli_error($db));
                if (mysqli_num_rows($fetchingUser) > 0) {
                    $userData = mysqli_fetch_assoc($fetchingUser);
                    $username = $userData['username'];
                    $contact_no = $userData['contact_no'];
                } else {
                    $username = "No Data";
                    $contact_no = "No Data";
                }

                // Fetch Candidate Name
                $fetchingCandidate = mysqli_query($db, "SELECT candidate_name FROM candidate_details WHERE id = '$candidate_id'") or die(mysqli_error($db));
                if (mysqli_num_rows($fetchingCandidate) > 0) {
                    $candidateData = mysqli_fetch_assoc($fetchingCandidate);
                    $candidate_name = $candidateData['candidate_name'];
                } else {
                    $candidate_name = "No Data";
                }
        ?>
                <tr>
                    <td><?php echo $sno++; ?></td>
                    <td><?php echo $username; ?></td>
                    <td><?php echo $contact_no; ?></td>
                    <td><?php echo $candidate_name; ?></td>
                    <td><?php echo $data['vote_date']; ?></td>
                    <td><?php echo $data['vote_time']; ?></td>
                </tr>
        <?php
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-info'>No votes available for this election.</div>";
        }
        ?>
    </div>
</div>
