<?php 

	//include header file
	include ('include/header.php');

?>


<div class="container-fluid header-img">
				<div class="row">
					<div class="col-md-6 offset-md-3">

						<div class="header">
							<h1 class="text-center">Donate the blood, save the life</h1>
						<p class="text-center">Donate the blood to help the others.</p>
						</div>


						<h1 class="text-center">Search The Donors</h1>
						<hr class="white-bar text-center">

						<form action="search.php" method="get" class="form-inline text-center" style="padding: 40px 0px 0px 5px;">
							<div class="form-group text-center justify-content-center">
							
								<select style="width: 220px; height: 45px;" name="city" id="city" class="form-control demo-default" required>
	<option value="">-- Select --</option>
	<!-- <optgroup title="Azad Jammu and Kashmir (Azad Kashmir)" label="&raquo; Azad Jammu and Kashmir (Azad Kashmir)"></optgroup> -->
	<option value="BHopal" >Bhopal</option>
	<option value="Indore" >Indore</option>
	<option value="Jabalpur" >Jabalpur</option>
	<option value="Gwalior" >Gwalior</option>
	<option value="Ujjain" >Ujjain</option>
	<option value="Sagar" >Sagar</option>
	<option value="Dewas" >Dewas</option>
	<option value="Satna" >Satna</option>
	<!-- <optgroup title="Balochistan" label="&raquo; Balochistan"></optgroup> -->
	<option value="Ratlam" >Ratlam</option>
	<option value="Rewa" >Rewa</option>
	<option value="Katni" >Katni</option>
	<option value="Singrouli" >Singrouli</option>
	<option value="Burhanpur" >Burhanpur</option>
	<option value="Morena" >Morena</option>
	<option value="Khandwa" >Khandwa</option>
	<option value="Bhind" >Bhind</option>
	<option value="Chindiwara" >Chindiwara</option>
	<option value="Guna" >Guna</option>
	<option value="Shivpuri" >Shivpuri</option>
	<option value="Vidisha" >Vidisha</option>
	<option value="chatterPur" >chatterPur</option>
	<option value="Damoh" >Damoh</option>
	<option value="Madsaur" >Madsaur</option>
	<option value="Khargone" >Khargone</option>
	<option value="Neemach" >Neemach</option>
	<option value="Pithampur" >Pithampur</option>
	<option value="Narmadapuram" >Narmadapuram</option>
	<option value="Itarsi" >Itarsi</option>
	<option value="Sehore" >Sehore</option>
	<option value="Betul" >Betul</option>
	<option value="Seoni" >Seoni</option>
	<option value="Datia" >Datia</option>
	<option value="Nagda" >Nagda</option>
	<option value="Shahdol" >Shahdol</option>
	<option value="Harda" >Harda</option>
	<!-- <optgroup title="Federally Administered Tribal Areas (FATA" label="&raquo; Federally Administered Tribal Areas (FATA"></optgroup>
	<option value="Bajaur Agency" >Bajaur Agency</option>
	<option value="Khyber Agency" >Khyber Agency</option>
	<option value="Kurram Agency" >Kurram Agency</option>
	<option value="Mohmand Agency" >Mohmand Agency</option>
	<option value="North Waziristan Agency" >North Waziristan Agency</option>
	<option value="Orakzai Agency" >Orakzai Agency</option>
	<option value="South Waziristan Agency" >South Waziristan Agency</option>
	<optgroup title="Islamabad Capital" label="&raquo; Islamabad Capital"></optgroup>
	<option value="Islamabad" >Islamabad</option>
	<optgroup title="North-West Frontier Province (NWFP)" label="&raquo; North-West Frontier Province (NWFP)"></optgroup>
	<option value="Abbottabad" >Abbottabad</option>
	<option value="Bannu" >Bannu</option>
	<option value="Batagram" >Batagram</option>
	<option value="Buner" >Buner</option>
	<option value="Charsadda" >Charsadda</option>
	<option value="Chitral" >Chitral</option>
	<option value="Dera Ismail Khan" >Dera Ismail Khan</option>
	<option value="Dir Lower" >Dir Lower</option>
	<option value="Dir Upper" >Dir Upper</option>
	<option value="Hangu" >Hangu</option>
	<option value="Haripur" >Haripur</option>
	<option value="Karak" >Karak</option>
	<option value="Kohat" >Kohat</option>
	<option value="Kohistan" >Kohistan</option>
	<option value="Lakki Marwat" >Lakki Marwat</option>
	<option value="Malakand" >Malakand</option>
	<option value="Mansehra" >Mansehra</option>
	<option value="Mardan" >Mardan</option>
	<option value="Nowshera" >Nowshera</option>
	<option value="Peshawar" >Peshawar</option>
	<option value="Shangla" >Shangla</option>
	<option value="Swabi" >Swabi</option>
	<option value="Swat" >Swat</option>
	<option value="Tank" >Tank</option>
	<optgroup title="Punjab" label="&raquo; Punjab"></optgroup>
	<option value="Alipur" >Alipur</option>
	<option value="Attock" >Attock</option>
	<option value="Bahawalnagar" >Bahawalnagar</option>
	<option value="Bahawalpur" >Bahawalpur</option>
	<option value="Bhakkar" >Bhakkar</option>
	<option value="Chakwal" >Chakwal</option>
	<option value="Chiniot" >Chiniot</option>
	<option value="Dera Ghazi Khan" >Dera Ghazi Khan</option>
	<option value="Faisalabad" >Faisalabad</option>
	<option value="Gujranwala" >Gujranwala</option>
	<option value="Gujrat" >Gujrat</option>
	<option value="Hafizabad" >Hafizabad</option>
	<option value="Jhang" >Jhang</option>
	<option value="Jhelum" >Jhelum</option>
	<option value="Kasur" >Kasur</option>
	<option value="Khanewal" >Khanewal</option>
	<option value="Khushab" >Khushab</option>
	<option value="Lahore" >Lahore</option>
	<option value="Layyah" >Layyah</option>
	<option value="Lodhran" >Lodhran</option>
	<option value="Mandi Bahauddin" >Mandi Bahauddin</option>
	<option value="Mianwali" >Mianwali</option>
	<option value="Multan" >Multan</option>
	<option value="Muzaffargarh" >Muzaffargarh</option>
	<option value="Nankana Sahib" >Nankana Sahib</option>
	<option value="Narowal" >Narowal</option>
	<option value="Okara" >Okara</option>
	<option value="Pakpattan" >Pakpattan</option>
	<option value="Rahim Yar Khan" >Rahim Yar Khan</option>
	<option value="Rajanpur" >Rajanpur</option>
	<option value="Rawalpindi" >Rawalpindi</option>
	<option value="Sahiwal" >Sahiwal</option>
	<option value="Sargodha" >Sargodha</option>
	<option value="Sheikhupura" >Sheikhupura</option>
	<option value="Shekhupura" >Shekhupura</option>
	<option value="Sialkot" >Sialkot</option>
	<option value="Toba Tek Singh" >Toba Tek Singh</option>
	<option value="Vehari" >Vehari</option>
	<optgroup title="Sindh" label="&raquo; Sindh"></optgroup>
	<option value="Badin" >Badin</option>
	<option value="Dadu" >Dadu</option>
	<option value="Ghotki" >Ghotki</option>
	<option value="Hyderabad" >Hyderabad</option>
	<option value="Jacobabad" >Jacobabad</option>
	<option value="Jamshoro" >Jamshoro</option>
	<option value="Karachi" >Karachi</option>
	<option value="Kashmore" >Kashmore</option>
	<option value="Khairpur" >Khairpur</option>
	<option value="Larkana" >Larkana</option>
	<option value="Matiari" >Matiari</option>
	<option value="Mirpur Khas" >Mirpur Khas</option>
	<option value="Naushahro Feroze" >Naushahro Feroze</option>
	<option value="Nawabshah" >Nawabshah</option>
	<option value="Qambar Shahdadkot" >Qambar Shahdadkot</option>
	<option value="Sanghar" >Sanghar</option>
	<option value="Shikarpur" >Shikarpur</option>
	<option value="Sukkur" >Sukkur</option>
	<option value="Tando Allahyar" >Tando Allahyar</option>
	<option value="Tando Muhammad Khan" >Tando Muhammad Khan</option>
	<option value="Tharparkar" >Tharparkar</option>
	<option value="Thatta" >Thatta</option>
	<option value="Umerkot" >Umerkot</option> -->
</select>
							</div>
							<div class="form-group center-aligned">
								<select name="blood_group" id="blood_group" style="padding: 0 20px; width: 220px; height: 45px;" class="form-control demo-default text-center margin10px">
									
									<option value="A+">A+</option>
									<option value="A-">A-</option>
									<option value="B+">B+</option>
									<option value="B-">B-</option>
									<option value="AB+">AB+</option>
									<option value="AB-">AB-</option>
									<option value="O+">O+</option>
									<option value="O-">O-</option>

								</select>
							</div>
							<div class="form-group center-aligned">
								<button type="submit" class="btn btn-lg btn-danger">Search</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- header ends -->

			<!-- donate section -->
			<div class="container-fluid red-background">
				<div class="row">
					<div class="col-md-12">
						<h1 class="text-center"  style="color: white; font-weight: 700;padding: 10px 0 0 0;">Donate The Blood</h1>
						<hr class="white-bar">
						<p class="text-center pera-text">
						Blood bank management  system is designed for 
      the blood  bank  to gather  blood  from various  
      Sources and  distribute it to needy  people who have 
      high  requirements  for  it.
	  is designed to handle  daily
      transactions  of  the blood  bank  and  search the 
      details  when  required.
	  For instance,when a person needs a certain type
        of  blood  and this type is not available in the 
        hospital, Family members and messages through  
        social media to those who can donate to them 
        seems that  there is lack of proper documentation
        process  takes longer  than the life of patient to the 
        most dangerous .
		There are several type of report that can been 
   generated  such as blood stock report .

   For instance,when a person needs a certain type
        of  blood  and this type is not available in the 
        hospital, Family members and messages through  
        social media to those who can donate to them 
        seems that  there is lack of proper documentation
        process  takes longer  than the life of patient to the 
        most dangerous .
		There are several type of report that can been 
   generated  such as blood stock report .
		
					</p>
						<a href="#" class="btn btn-default btn-lg text-center center-aligned">Become a Life Saver!</a>
					</div>
				</div>
			</div>
			<!-- end doante section -->
			

			<div class="container">
				<div class="row">
    				<div class="col">
    					<div class="card">
     						<h3 class="text-center red">Our Vission</h3>
								<img src="img/binoculars.png" alt="Our Vission" class="img img-responsive" width="168" height="168">
								<p class="text-center">
								The system provides a high-end ,efficient, highly 
   available and scalable  system to bridge the gap 
   Between the donors and recipients .There are several type of report that can been 
   generated  such as blood stock report .
   The system also give the information to the donor 
   About blood. 

	</p>
						</div>
    				</div>
    				
    				<div class="col">
    					<div class="card">
      							<h3 class="text-center red">Our Goal</h3>
								<img src="img/target.png" alt="Our Vission" class="img img-responsive" width="168" height="168">
								<p class="text-center">
								This web based  application provides :
								To ensure hospital to have  good  supply and 
     inventory of blood bags.
	 To manage the  information of   its blood  donor.
    Function to check  if the person donate blood 
    for its 3 months .To provide immediate storage and retrieval of 
    Data and information.

							</p>
						</div>
    				</div>
    			
    				<div class="col">
    					<div class="card">
      						<h3 class="text-center red">Our Mission</h3>
								<img src="img/goal.png" alt="Our Vission" class="img img-responsive" width="168" height="168">
								<p class="text-center">
								The future of blood bank management system(lives)in 
  using new  technologies  and   innovative  approaches 
  to  improve  patient care  and  blood  bank practices.
  This research  study  does not cover  the actual 
   blood collection  activity , And  actual  blood 
   transfusion  operation.	
							</p>
							</div>
   			 		</div>
 			</div>
 		</div>

			<!-- end aboutus section -->


<?php
//include footer file
include ('include/footer.php');
 ?>