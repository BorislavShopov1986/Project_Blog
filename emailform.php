<div class="right-bottom">
	
       <form id="email-form" action="" method="post">
                
                 <?php if($_POST) echo "<label style=\"display: block; color: red;\">$validateMessage</label>";?>
       	        <input type="text" placeholder="Enter your Email" name="email" id="email">
       	        <input type="submit" name="submitform" id="submitForm" value="Subscribe">
       </form>
</div>