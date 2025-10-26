<div class="row my-3">

    <div class="col-4">
        <h3>Add New Election</h3>
        <form action="" method="POST">
            <div class="form-group">
                <input type="text" name="election_topic" placeholder="Election Topic" class="form-control" required />
            </div>

            <div class="form-group">
                <input type="number" name="number_of_candidates" placeholder="No of Candidates" class="form-control" required />
            </div>

            <div class="form-group">
                <input type="text" onfocus="this.type='date'" name="starting_date" placeholder="Starting Date" class="form-control" required />
            </div>

            <div class="form-group mb-3">
                <input type="text" onfocus="this.type='date'" name="ending_date" placeholder="Ending Date" class="form-control" required />
            </div>

            <input type="submit" value="Add Election" name="addElectionBtn" class="btn btn-success" />
        </form>
    </div>

    <div class="col-8">
        <h3>Upcoming Election</h3>
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
                                <a href='editElection.php?id={$row['id']}' class='btn btn-sm btn-primary'>Edit</a>
                                <a href='deleteElection.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this election?');\">Delete</a>
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
</div>

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
        $status = "InActive"; // not started yet
    } elseif ($current_date > $ending_date) {
        $status = "InActive"; // already ended
    } else {
        $status = "Active"; // ongoing election
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
