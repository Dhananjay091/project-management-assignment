<?php  
include 'connection.php';
class User{
	public $db;
	/*** for login process ***/
	public function check_login($emailusername, $password){
		$conn = db();
		$password = md5($password);
		$sql="SELECT uid, usertype from users WHERE uemail='$emailusername'  and upass='$password'";
		//checking if the email is available in the table
		$result    = $conn->query($sql);
		$user_data = $result->fetch_assoc();
		$count_row = $result->num_rows;
		if ($count_row == 1) {
			// this login variable will use for the session thing
			$_SESSION['login'] = true;
			$_SESSION['uid'] = $user_data['uid'];
			$_SESSION['usertype'] = $user_data['usertype'];
			return true;
		}else{
			return false;
		}
	}

	/*** for showing the User Details ***/
	public function get_UserDetails($uid){
		$conn = db();
		$sql="SELECT fullname FROM users WHERE uid = $uid";
		$result = $conn->query($sql);
		$user_data = $result->fetch_assoc();
		echo $user_data['fullname'];
	}
	public function get_UserType($uid){
		$conn = db();
		$sql="SELECT fullname FROM users WHERE uid = $uid";
		$result = $conn->query($sql);
		$user_data = $result->fetch_assoc();
		echo $user_data['fullname'];
	}
	public function get_AllEmployeeListSm(){
		$conn = db();
		$sql="SELECT * FROM users where usertype = 2";
		$result = $conn->query($sql);	
		$user_data = $result->fetch_all();
		return $user_data;
	}
	public function get_AllUserdDetails(){
		$conn = db();
		$sql="SELECT * FROM users join usertype on users.usertype=usertype.utid";
		$result = $conn->query($sql);
		$user_data = $result->fetch_all();
		return $user_data;
	}
	/*** starting the session ***/
	public function get_session(){
		return $_SESSION['login'];
	}

	public function user_logout(){
		$_SESSION['login'] = FALSE;
		session_destroy();
	}
}

?>
