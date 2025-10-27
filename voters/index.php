<?php
    require_once ("inc/header.php");
    require_once ("inc/navigation.php");  

?>

            <div class="row my-3">
                <div class="col-12">
                    <h3>Voter Panel</h3>

                    <?php
                    
                    $fetchingActiveElections = mysqli_query($db, "SELECT * FROM elections WHERE status = 'Active'") or die (mysqli_error($db));
                    $countActiveElections = mysqli_num_rows($fetchingActiveElections);

                    if($countActiveElections > 0){
                        while($data = mysqli_fetch_assoc($fetchingActiveElections)){
                            $fetching_id = $data['id'];
                            $election_topic = $data['election_topic'];
                            ?>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="bg-green text-white "><h5>ELECTION TOPIC : <?php echo strtoupper($election_topic); ?></h5></th>
                                    </tr>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Candidate Details</th>
                                        <th># of Votes</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $fetchingCandidates = mysqli_query($db, "SELECT * FROM candidate_details WHERE election_id = '$fetching_id'") or die (mysqli_error($db));

                                    // print_r($fetchingCandidates);
                                    while($candidateData = mysqli_fetch_assoc($fetchingCandidates)){
                                        $candidate_id = $candidateData['id'];
                                        $candidate_photo = $candidateData['candidate_photo'];


                                        // fetching candidates votes

                                        $countingVotes = mysqli_query($db, "SELECT * FROM votings WHERE candidate_id = '$candidate_id'") or die (mysqli_error($db));
                                        $totalVotes = mysqli_num_rows($countingVotes);


                                        // echo $isVoteCasted;

                                        ?>

                                        <tr>
                                            <td><img src="<?php echo $candidate_photo ?>" class="candidate_photo" alt=""></td>

                                            <td><?php echo "<b>". $candidateData['candidate_name']."</b><br />".$candidateData['candidate_details'] ?></td>

                                            <td><?php echo $totalVotes ?></td>
                                            <td>

                                             <?php

                                            $checkIfVoteCasted = mysqli_query($db, "SELECT * FROM votings WHERE voters_id = '".$_SESSION['user_id']."' AND election_id = '".$election_id."' ") or die(mysqli_error($db));

                                            $isVoteCasted = mysqli_num_rows($checkIfVoteCasted);


                                        if($isVoteCasted >0){

                                            $voteCastedData = mysqli_fetch_assoc($checkIfVoteCasted);
                                            $voteCastedToCandidate = $voteCastedData['candidate_id'];


                                        if($voteCastedToCandidate == $candidate_id){
                                                ?>

                                                <img src="../assets/images/vote.png" width="100px" alt="vote done">

                                            <?php

                                            }

                                        }else{
                                            ?>

                                            <button class="btn btn-md btn-success" onclick="CastVote(<?php echo $election_id; ?> , <?php echo $candidate_id; ?>,<?php echo $_SESSION['user_id']; ?>)">Vote</button>

                                            <?php

                                             }

                                            ?>

                                            </td>
                                       </tr>
                                        
                                        <?php
                                    }

                                    ?>
                                    

                                </tbody>
                            </table>
                            
                            <?php

                            }
                        }else{
                            echo "No any active elections found.";
                        }
                    
                ?>

                </div>
            </div>

<script>
    
const CastVote = (election_id, candidate_id, voters_id)=>{
    $.ajax({
        type: "POST",
        url: "inc/ajaxCalls.php",
        data: "e_id="+election_id+"&c_id="+candidate_id+"&v_id="+voters_id,
        success: functions(response){
            consol.log(response);

        }
    })
}

</script>


<?php
     require_once ("inc/footer.php");

?>
