<?php
include 'public_header.php'
?>
<?php
if(isset($_POST['submit'])){
	extract($_POST);
	$q="SELECT * FROM `tbl_login` WHERE `Username`='$username' AND `login_password`='$password'";
	$res=select($q);
	if(sizeof($res)>0){
		$_SESSION['Username']=$res[0]['Username'];
		$_SESSION['Type']=$res[0]['login_type'];
		$lid = $_SESSION['Username'];

		if($res[0]['login_type']=="admin"){
		return redirect("admin_home.php");
		}
		else if ($res[0]['login_type']=="staff"){
			$q="select * from tbl_staff inner join tbl_login USING (Username) where Username='$lid'";
			$res1=select($q);
			if (sizeof($res)>0) {
				$_SESSION['Staff_id']=$res1[0]['Staff_id'];
				$sid=$_SESSION['Staff_id'];
				if($res[0]['login_Status']=='1'){
					return redirect("staff_home.php");
				}
				else{
					alert("Sorry Your Are In an inactive State.");
					return redirect('login2.php');
				}
				

			}
			
		}
		else if ($res[0]['login_type']=="customer"){
			$q="select * from tbl_customer inner join tbl_login USING (Username) where Username='$lid'";
			$res=select($q);
			if (sizeof($res)>0) {
				$_SESSION['cust_id']=$res[0]['Cust_id'];
				$cusid=$_SESSION['cust_id'];

				if($res[0]['login_Status']=='1'){
					return redirect("custhome.php");
				}
				else{
					alert("Sorry. You have been inactivated...");
					return redirect('signin.php');
				}
				

			}
			
		}
		else if ($res[0]['Type']=="courier"){
			$q="select * from tbl_courier inner join tbl_login USING (Username) where Username='$lid'";
			$res=select($q);
			if (sizeof($res)>0) {
				$_SESSION['Cour_id']=$res[0]['Cour_id'];
				$courid=$_SESSION['Cour_id'];

				
				if($res[0]['User_Status']=='1'){
					return redirect("courierhome.php");

				}
				else{
					alert("Sorry Your Are In @ Inactive State......");
					return redirect('signin.php');
				}
				
			}
		}
}
else
{
	alert("Invalid username or password");
}
}

?>
		<div id="wrapper">
			<div class="rslides_container">
				<ul class="rslides" id="slider1">
					<li>
						<div class="banner-info text-left">
							<font color="red">
								<h1 style="margin-top: -2em">Sign in</h1><br>
							<form method="post" style="width: 500px">
								Username : <input type="email" name="username" maxlength="40" class="form-control" required=""><br><br>
								Password : <input type="Password" name="password" maxlength="20" required="" class="form-control"><br><br>
								<input type="submit" name="submit" value="Sign in" class="btn btn-danger">
							</form>
							</font>
						</div>

					</li>

				</ul>
			</div>
		</div>
	</div>

<?php 
include 'footer.php' ?>