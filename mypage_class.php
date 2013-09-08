<?php
$obj = new program();

	class program {
		public function __construct() {		
			if(isset($_REQUEST['class'])) {
				$class = $_REQUEST['class'];
				$obj = new $class();
			} else {	
				$obj = new homepage();
			}
		
		}
	}
	class page {	
		public function __construct() {
			if($_SERVER['REQUEST_METHOD'] == 'GET') {
				$this->get();
			} else {
				$this->post();
			}	
		}
		protected function get() {
			echo "welcome to our bank tracking program<br>";
			echo '<a href="mypage_class.php?class=register">register now</a>' . "<br> \n";
			//echo '<a href="mypage_class.php?class=form2">Form 2</a>' . "<br> \n";
	                echo '<a href="mypage_class.php?class=login">Login Now</a>' . "<br> \n";
		}

		protected function post() {
			echo "<br>welcome to our bank tracking program<br>";
			echo '<a href="mypage_class.php?class=register">register now</a>' . "<br> \n";
			//echo '<a href="mypage_class.php?class=form2">Form 2</a>' . "<br> \n";
	                echo '<a href="mypage_class.php?class=login">Login Now</a>' . "<br> \n";
		
		}
	}
	class register extends page {
		public function get() {
			echo 'PLease register' . "<br> \n";
			//echo '<a href="mypage_class.php?class=register">register</a>' . "<br> \n";
			//echo '<a href="mypage_class.php?class=form2">Form 2</a>' . "<br> \n";
			//echo '<a href="mypage_class.php">Homepage</a>' . "<br> \n";
			
			$form = '<FORM action="mypage_class.php?class=register" method="post">
    					 <P>
   					 <LABEL for="firstname">First name: </LABEL>
             		 <INPUT type="text" name="firstname" id="firstname"><BR>
    					 <LABEL for="lastname">Last name: </LABEL>
              		 <INPUT type="text" name="lastname" id="lastname"><BR>
    					 <LABEL for="Username">Choose a Username: </LABEL>
                     <INPUT type="text" name="Username"id="username"><BR>
					 <LABEL for="password">choose a password: </LABEL>
					 <INPUT type=password name="password"id="password"><BR>
                     <INPUT type="submit" value="Send"> <INPUT type="reset">
                     </P>
                     </FORM>';
			
			echo $form;
		}
		public function post(){
		$obj = new writeinfo;
		$obj->write();
		//$login = new login;	
		
		}
		
	}
	class homebank extends page {
		//public function id(){
		//$this->$id = $_POST['username'] ;
		//print_r($id);}
		public function __construct() {
			$id = $_SESSION['sessioninfo'] ;
			//print_r($id);
			$users = $id[2];
			echo "<br>Hi $users, what would you like to do today?" . "<br> \n";
			echo '<a href="mypage_class.php?class=debitcredit">add new transactions</a>' . "<br> \n";
		    echo '<a href="mypage_class.php?class=form2">Form 2</a>' . "<br> \n";
			echo '<a href="mypage_class.php">Homepage</a>' . "<br> \n";
		}
	}
	class homepage extends page {}

	class login extends page{ 
	  public function get(){
	   echo "login to get free money";
           
            $login_form = '<FORM action ="mypage_class.php?class=login" method="post">
			                <p>Your userName <input type="text"name="username">
                            <p>enter your password<input type="text"name="password">  
                            <input type ="submit" name="submit" value ="Submit Now"/>';	
	      
      echo $login_form;
	  }
	    public function post(){
	      $obj = new writeinfo;
	      $obj->read_login();
	    
	  }  
	}  
	
	class debitcredit extends page {
		public function __construct() {
			$form = '<br>
              <FORM action="index.php?page=bankform" method="post">
                <fieldset>
                  <LABEL for="amount">Amount: </LABEL>
                    <INPUT type="text" name="amount" id="lastname"><BR>
                  <LABEL for="source">Source: </LABEL>
                    <INPUT type="text" name="source" id="lastname"><BR>
                    <INPUT type="radio" name="type" value="debit"> Debit<BR>
                    <INPUT type="radio" name="type" value="credit"> Credit<BR>
                    <INPUT type="checkbox" name="moretranstype" value="yes"> More Trans<BR>
                    <INPUT type="submit" value="Send"> <INPUT type="reset">
                </fieldset>
              </FORM>';
	
			echo  $form;
			$this->$id = $id;
		}
	}
	
	
	class writeinfo  {
	
	 
	  public function write() { 
	     
	  	$first = $_POST['firstname'];
	  	$last = $_POST['lastname'];
	  	$pass = $_POST['password'];
	  	$username = $_POST['Username'];
	  	
	  	if ($first  == NULL || $last == NULL ||$username ==NULL ||$pass==NULL) {
	  	echo 'You forgot to fill out a field<br>';
	  	echo '<a href="mypage_class.php?class=register">Please click to try again</a>' . "<br> \n";
	  	//throw new exception('you are missing something');
	 
	  	
	  	}   else{
	  	$keys=array("firstname" , "lastname", "Username", "password");
	  	
	  	
	  	//$combine = array_combine($heys,$_POST);
	  	//print_r ($combine);
	  	$id = $_POST['Username'];
	  	 $keys[]=$_POST;
	  	 
	  	 if(@$handle=fopen("write/$id.csv", 'r')) {
	  	 	             echo "this username is already taken";
	  	 	             echo '<a href="mypage_class.php?class=register">Please click to try again</a>' . "<br> \n";
	  	 	
	  	 	
	  	 	            }else{
	     $username = fopen("write/$id.csv", 'w');
	    // $combineobj[]=$combine;
	    // fputcsv($username,$combineobj);
	     fputcsv($username,$_POST);
	     echo 'the program works :-) <br> ';
	     echo '<a href="mypage_class.php?class=login">Login Now</a>' . "<br> " ;
	  	 	            }
	   	   }
	  }
	 // try{
	  
	  
	//}
	
	  public function read_login() {
	  	$id= $_POST['username'];
	  	$row = 1;
	  	if ((@$handle = fopen("write/$id.csv", "r")) == FALSE) {
	  		  echo "$id is not found in our system.".'<br>';
	  		  echo '<a href="mypage_class.php?class=login">Login Now</a>' . "<br> " ;
	  		  echo '<a href="mypage_class.php?class=register">register now</a>' . "<br> \n";
	  	} 
	  		if ((@$handle = fopen("write/$id.csv", "r")) !== FALSE){
	  		 $record = fgetcsv($handle, 0, ",");  
	  			
	  				
	  				//print_r($record);
	  				fclose($handle);
	  				$pass = $record['3'];
	  				if ($_POST['password'] == $pass){
	  				echo "$id you have successfully logged in";
	  				session_start();
	  				$_SESSION['sessioninfo'] = $record;
	  			    //print_r ($_SESSION);
	  				$obj = new homebank();
	  				} else { echo 'your password is incorrrect';
	  				
	  				$obj = new homepage;
	  				  }
	  				 
	  			
	  			
	  			
	  			 
	  		}
	  		
	  	}
	  
	}
  
	
	     
	     
		
	  
	 
	 
	 
	 
	 
	 /*class opencsv{
	 	public function handle(){
	 	$handle  = fopen("$id.csv", "r"); 
	 		while (($record = fgetcsv($handle, 0, ",")
	 	
	 	}
	 	
	 
	 } */
?>
