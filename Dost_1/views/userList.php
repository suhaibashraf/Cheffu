<?php
	
	$_SESSION['username'] = $this->session->userdata('username'); // Must be already set
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    
	<title>CodeIgniter Demo - Chat</title>

	<script type="text/javascript" src="http://demo.webexplorar.com/codeigniter/application/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chat.js"></script>
  
    <link type="text/css" rel="stylesheet" media="all" href="http://demo.webexplorar.com/codeigniter/application/css/chat.css" />
    <link type="text/css" rel="stylesheet" media="all" href="http://demo.webexplorar.com/codeigniter/application/css/screen.css" />
    
    <!--[if lte IE 7]>
    <link type="text/css" rel="stylesheet" media="all" href="http://demo.webexplorar.com/codeigniter/application/css/screen_ie.css" />
    <![endif]--> 

</head>
<body>

<div id="container">

	<h2>Online Users</h2>

     <table width="45%" cellspacing="1" cellpadding="2" class="tableContent" style="margin-left:0px !important;">
        <tbody>
          <tr style="background-color:#9EB0E9;  font-size:13px; font-weight:bold; color:#fff;">
            <th>Online</th>
            <th>User Id</th>
            <th>User Name</th>
          </tr>
                              
		<?php
								
		if(isset($listOfUsers))
		{
			foreach($listOfUsers->result() as $res)
			{
		?>

          <tr style="background-color:#efefef;">
            <td><?php if($res->online==1) echo 'Active'; else echo 'Inactive'; ?></td>
            <td><?php echo $res->userId; ?></td>
            <td><?php if($_SESSION['username']==$res->userName) { ?>
                 		<a href="#" style="text-decoration:none">
                      <?php } else { ?>  
                        <a href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $res->userName; ?>');">
                <?php } ?>      
                <?php echo $res->userName;  ?>
                        </a>
                  </td>
            </tr>
			<?php 	
										 
			} // end foreach loop
		} // end if condition
		?>	  	  	
			
		</tbody>
	</table>
    
 </div>

</body>
</html>   