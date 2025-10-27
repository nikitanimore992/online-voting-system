<?php
include("config.php");

// ✅ Start session if not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Handle form submission
if (isset($_POST['addCandidateBtn'])) {

    $election_id = $_POST['election_id'];
    $candidate_name = $_POST['candidate_name'];
    $candidate_details = $_POST['candidate_details'];
    $inserted_by = $_SESSION['username'];
    $inserted_on = date('Y-m-d H:i:s');

    // ✅ Folder Path for Uploaded Photos
    $target_folder = "assets/images/candidate_photos/";
    if (!file_exists($target_folder)) mkdir($target_folder, 0777, true);

    // File Upload Handling
    $unique_name = rand(111111111, 999999999) . "_" . rand(111111111, 999999999);
    $filename = preg_replace("/[^a-zA-Z0-9.]/", "_", basename($_FILES['candidate_photo']['name']));
    $candidate_photo = $target_folder . $unique_name . "_" . $filename;
    $candidate_photo_tmp = $_FILES['candidate_photo']['tmp_name'];
    $candidate_photo_type = strtolower(pathinfo($candidate_photo, PATHINFO_EXTENSION));
    $allowed_types = array('jpg', 'jpeg', 'png');
    $image_size = $_FILES['candidate_photo']['size'];

    if ($image_size < 2000000) { // 2MB limit
        if (in_array($candidate_photo_type, $allowed_types)) {
            if (move_uploaded_file($candidate_photo_tmp, $candidate_photo)) {

                $stmt = $db->prepare("INSERT INTO candidate_details (election_id, candidate_name, candidate_details, candidate_photo, inserted_by, inserted_on) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isssss", $election_id, $candidate_name, $candidate_details, $candidate_photo, $inserted_by, $inserted_on);

                if ($stmt->execute()) {
                    echo "<script>alert('✅ Candidate Added Successfully!');location.assign('index.php?addCandidatesPage=1');</script>";
                } else {
                    echo "<script>alert('❌ Database Error! Try Again.');location.assign('index.php?addCandidatesPage=1');</script>";
                }
            } else {
                echo "<script>alert('❌ Image Upload Failed!');</script>";
            }
        } else {
            echo "<script>alert('❌ Invalid File Type! Only JPG, PNG, GIF Allowed.');</script>";
        }
    } else {
        echo "<script>alert('❌ File Too Large! Max 2MB Allowed.');</script>";
    }
}
?>

<div class="row my-3">

    <!-- ✅ Left Side: Add Candidate Form -->
    <div class="col-4">
        <h3>Add New Candidates</h3>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <select class="form-control" name="election_id" required>
                    <option value="">Select Election</option>
                    <?php
                    $fetchingElections = mysqli_query($db, "SELECT * FROM elections") or die(mysqli_error($db));
                    if (mysqli_num_rows($fetchingElections) > 0) {
                        while ($row = mysqli_fetch_assoc($fetchingElections)) {
                            $election_id = $row['id'];
                            $election_name = $row['election_topic'];
                            $allowed_candidates = $row['no_of_candidates'];

                            $fetchingCandidates = mysqli_query($db, "SELECT * FROM candidate_details WHERE election_id='$election_id'");
                            $added_candidates = mysqli_num_rows($fetchingCandidates);

                            if ($added_candidates < $allowed_candidates) {
                                echo "<option value='$election_id'>$election_name ($allowed_candidates - $added_candidates slots left)</option>";
                            }
                        }
                    } else {
                        echo "<option value=''>Please add election first</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <input type="text" name="candidate_name" placeholder="Candidate Name" class="form-control" required />
            </div>

            <div class="form-group">
                <input type="file" name="candidate_photo" class="form-control" required />
            </div>

            <div class="form-group mb-3">
                <input type="text" name="candidate_details" placeholder="Candidate Details" class="form-control" required />
            </div>

            <input type="submit" value="Add Candidate" name="addCandidateBtn" class="btn btn-success" />
        </form>
    </div>

    <!-- ✅ Right Side: Candidate List -->
    <div class="col-8">
        <h3>Candidates Details</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th>Election</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $fetchingData = mysqli_query($db, "
                    SELECT c.*, e.election_topic 
                    FROM candidate_details c
                    JOIN elections e ON c.election_id = e.id
                    ORDER BY c.id DESC
                ") or die(mysqli_error($db));

                if (mysqli_num_rows($fetchingData) > 0) {
                    $sno = 1;
                    while ($row = mysqli_fetch_assoc($fetchingData)) {
                        echo "<tr>
                            <td>{$sno}</td>
                            <td><img src='{$row['candidate_photo']}' alt='Candidate Photo' style='width:60px;height:60px;object-fit:cover;border-radius:5px;'></td>
                            <td>{$row['candidate_name']}</td>
                            <td>{$row['candidate_details']}</td>
                            <td>{$row['election_topic']}</td>
                            <td>
                                <a href='#' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='#' class='btn btn-danger btn-sm'>Delete</a>
                            </td>
                        </tr>";
                        $sno++;
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No candidates added yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
