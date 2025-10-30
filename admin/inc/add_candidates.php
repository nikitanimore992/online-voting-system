<?php
include("config.php");
if (session_status() === PHP_SESSION_NONE) session_start();

// ✅ Delete Candidate + Image
// if (isset($_GET['delete_id'])) {
//     $delete_id = $_GET['delete_id'];

//     // Fetch image path
//     $result = $db->prepare("SELECT candidate_photo FROM candidate_details WHERE id = ?");
//     $result->bind_param("i", $delete_id);
//     $result->execute();
//     $result->bind_result($photo_path);
//     $result->fetch();
//     $result->close();

//     // Delete file from folder
//     $full_path = "../" . $photo_path;
//     if (file_exists($full_path)) unlink($full_path);

//     // Delete record
//     $stmt = $db->prepare("DELETE FROM candidate_details WHERE id = ?");

//     $stmt->bind_param("i", $delete_id);
//     $stmt->execute();

//     echo "<div class='alert alert-danger my-3' role='alert'>
//             Candidate deleted successfully!
//           </div>";
// }

// ✅ Add Candidate
if (isset($_POST['addCandidateBtn'])) {
    $election_id = $_POST['election_id'];
    $candidate_name = $_POST['candidate_name'];
    $candidate_details = $_POST['candidate_details'];
    $inserted_by = $_SESSION['username'];
    $inserted_on = date('Y-m-d H:i:s');

    $target_folder = "../assets/images/candidate_photos/";
    if (!file_exists($target_folder)) mkdir($target_folder, 0777, true);

    if (isset($_FILES['candidate_photo']) && $_FILES['candidate_photo']['error'] == 0) {
        $unique_name = rand(111111111, 999999999) . "_" . rand(111111111, 999999999);
        $filename = preg_replace("/[^a-zA-Z0-9.]/", "_", basename($_FILES['candidate_photo']['name']));
        $upload_path = $target_folder . $unique_name . "_" . $filename;
        $tmp_name = $_FILES['candidate_photo']['tmp_name'];
        $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png'];
        $file_size = $_FILES['candidate_photo']['size'];

        if (!in_array($file_ext, $allowed_types)) {
            echo "<div class='alert alert-warning'>❌ Invalid File Type! Only JPG/PNG allowed.</div>";
            exit;
        }
        if ($file_size > 2 * 1024 * 1024) {
            echo "<div class='alert alert-warning'>❌ File too large! Max 2MB.</div>";
            exit;
        }

        if (move_uploaded_file($tmp_name, $upload_path)) {
            $db_photo_path = "assets/images/candidate_photos/" . $unique_name . "_" . $filename;
            $stmt = $db->prepare("INSERT INTO candidate_details (election_id, candidate_name, candidate_details, candidate_photo, inserted_by, inserted_on) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssss", $election_id, $candidate_name, $candidate_details, $db_photo_path, $inserted_by, $inserted_on);
            if ($stmt->execute()) {
                echo "<script>alert('✅ Candidate added successfully!');location.assign('index.php?addCandidatePage=1');</script>";
            } else {
                echo "<script>alert('❌ Database error!');</script>";
            }
        } else {
            echo "<div class='alert alert-danger'>❌ Image upload failed!</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>⚠️ No file selected or upload error.</div>";
    }
}
?>

<div class="row my-3">
    <div class="col-4">
        <h3>Add New Candidate</h3>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <select class="form-control" name="election_id" required>
                    <option value="">Select Election</option>
                    <?php
                    $fetchingElections = mysqli_query($db, "SELECT * FROM elections");
                    while ($row = mysqli_fetch_assoc($fetchingElections)) {
                        $eid = $row['id'];
                        $ename = $row['election_topic'];
                        $allowed = $row['no_of_candidates'];
                        $added = mysqli_num_rows(mysqli_query($db, "SELECT * FROM candidate_details WHERE election_id='$eid'"));
                        if ($added < $allowed) {
                            echo "<option value='$eid'>$ename ($allowed - $added slots left)</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group"><input type="text" name="candidate_name" placeholder="Candidate Name" class="form-control" required /></div>
            <div class="form-group"><input type="file" name="candidate_photo" class="form-control" required /></div>
            <div class="form-group mb-3"><input type="text" name="candidate_details" placeholder="Candidate Details" class="form-control" required /></div>
            <input type="submit" value="Add Candidate" name="addCandidateBtn" class="btn btn-success" />
        </form>
    </div>

    <div class="col-8">
        <h3>Candidates List</h3>
        <table class="table table-bordered">
            <thead>
                <tr><th>S.No</th><th>Photo</th><th>Name</th><th>Details</th><th>Election</th><th>Action</th></tr>
            </thead>
            <tbody>
                <?php
                $fetchingData = mysqli_query($db, "SELECT c.*, e.election_topic FROM candidate_details c JOIN elections e ON c.election_id = e.id ORDER BY c.id DESC");
                if (mysqli_num_rows($fetchingData) > 0) {
                    $sno = 1;
                    while ($row = mysqli_fetch_assoc($fetchingData)) {
                        echo "<tr>
                            <td>{$sno}</td>
                            <td><img src='../{$row['candidate_photo']}' class='candidate-photo' style='border-radius: 10px;'></td>
                            <td>{$row['candidate_name']}</td>
                            <td>{$row['candidate_details']}</td>
                            <td>{$row['election_topic']}</td>
                            <td>
                                <a href='#' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='#' class='btn btn-danger btn-sm' onclick='DeleteData({$row['id']})'>Delete</a>
                            </td>
                        </tr>";
                        $sno++;
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center text-muted'>No candidates added yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- <script>
// function DeleteData(id) {
//     if (confirm("Are you sure you want to delete this candidate?")) {
//         location.assign("index.php?addCandidatesPage=1&delete_id=" + id);
//     }
// }
// </script> -->
