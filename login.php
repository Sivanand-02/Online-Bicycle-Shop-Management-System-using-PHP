<?php 
include 'public_header.php';

if(isset($_POST['submit'])){
	extract($_POST);
	$q="SELECT * FROM `tbl_login` WHERE `Username`='$username' AND `login_password`='$password' and login_status=1";
	$res=select($q);
	if(sizeof($res)>0){
		$_SESSION['Username']=$res[0]['Username'];
		$_SESSION['Type']=$res[0]['login_type'];
		$uid=$_SESSION['Username'];
		if($res[0]['login_type']=="admin"){
			return redirect("admin_home.php");
		}
		else if ($res[0]['login_type']=="staff"){
			$q="select * from tbl_staff where Username='$uid'";
			$res=select($q);
			if (sizeof($res)>0) {
				$_SESSION['Staff_id']=$res[0]['Staff_id'];
				$sid=$_SESSION['Staff_id'];
			}
			return redirect("staff_home.php");
		}
		else if ($res[0]['login_type']=="customer"){

			$q="select * from tbl_customer where Username='$uid'";
			$res=select($q);
			if (sizeof($res)>0) {
				$_SESSION['Cust_id']=$res[0]['Cust_id'];
				$cid=$_SESSION['Cust_id'];
			}


			return redirect("user_home.php");
		}
		else{
			alert("Invalid username or password !");
		}
}
else
{
	alert("Invalid username or password ! ");
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
include 'footer.php';
?>