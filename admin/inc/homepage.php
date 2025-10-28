

<?php
if (isset($_POST['addElectionBtn'])) {
    $election_topic = mysqli_real_escape_string($db, $_POST['election_topic']);
    $number_of_candidates = mysqli_real_escape_string($db, $_POST['number_of_candidates']);
    $starting_date = mysqli_real_escape_string($db, $_POST['starting_date']);
    $ending_date = mysqli_real_escape_string($db, $_POST['ending_date']);
    $inserted_by = $_SESSION['username'];
    $inserted_on = date("Y-m-d H:i:s");

    // ✅ Determine status
    $current_date = date("Y-m-d");

    if ($current_date < $starting_date) {
        $status = "InActive";  // Not started yet
    } elseif ($current_date >= $starting_date && $current_date <= $ending_date) {
        $status = "Active";    // Ongoing
    } else {
        $status = "Expired";   // Ended
    }

    // ✅ Prepared statement
    $stmt = $db->prepare("INSERT INTO elections (election_topic, no_of_candidates, starting_date, ending_date, status, inserted_by, inserted_on) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssss", $election_topic, $number_of_candidates, $starting_date, $ending_date, $status, $inserted_by, $inserted_on);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Election added successfully!');</script>";
        echo "<script>location.assign('index.php?addElementPage=1&added=1')</script>";
    } else {
        echo "<script>alert('❌ Election add failed. Please try again.');</script>";
    }

    $stmt->close();
}
?>
<center>
    <div class="col-12">
        <h3>Elections</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Election Name</th>
                    <th scope="col"># Candidates</th>
                    <th scope="col">Starting Date</th>
                    <th scope="col">Ending Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // ✅ Fetch data from DB
                $result = $db->query("SELECT * FROM elections ORDER BY starting_date ASC");
                if ($result && $result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        $election_id = $row['id'];
                        $statusColor = ($row['status'] == 'Active') ? 'text-success' : 'text-danger';
                        echo "
                        <tr>
                            <td>{$i}</td>
                            <td>{$row['election_topic']}</td>
                            <td>{$row['no_of_candidates']}</td>
                            <td>{$row['starting_date']}</td>
                            <td>{$row['ending_date']}</td>
                            <td class='{$statusColor}'><strong>{$row['status']}</strong></td>
                            <td>
                                <a href='index.php?viewResult={$election_id}' class='btn btn-success btn-sm'>View Result</a>
                                </td>
                        </tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center text-muted'>No upcoming elections found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</center>
