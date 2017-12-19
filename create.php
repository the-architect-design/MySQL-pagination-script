<!-- Welcome to the scripts database of HIOX INDIA      -->
<!-- This tool is developed and a copyright             -->
<!-- product of HIOX INDIA.			        -->
<!-- For more information visit http://www.hscripts.com -->

<?php

   $link = mysql_connect($hostname, $username,$password);
   $vv="";
   if($link)
   {

 	$dbcon = mysql_select_db($dbname);

	if($dbcon)
	{
	    $res1=mysql_query("CREATE TABLE IF NOT EXISTS `paginations` (
				  `name` varchar(100) NOT NULL,
				  `collage` varchar(100) NOT NULL,
				  `email` varchar(100) NOT NULL
				)",$link);
		
            $ins1=mysql_query("INSERT INTO `paginations` (`name`, `collage`, `email`) VALUES
					 ('Anitha Manohar', 'University departments of Anna University Chennai', 'anitha@domain.com'),
					 ('Aravind', 'P.S.G. College of Technology', 'appu@domain.com'),
					 ('Arun', 'University departments of Anna University Chennai, MIT ', 'arunking@domain.com'),
					 ('Aswathy Menon', 'Coimbatore Institute of Technology- Coimbatore', 'aswathy@domain.com'),
					 ('Balu', 'Government College of Technology- Coimbatore', 'bj@domain.com'),
					 ('Banupriya', 'Kumaraguru College of Technology', 'banu@domain.com'),
					 ('Chandru', 'Central Electrochemical Research Institute(CSIR)', 'chandru@domain.com'),
					 ('Diaz', 'Government College of Engineering â€“ Salem', 'dxm@domain.com'),
					 ('Deepi', 'P.S.G. College of Technology- Coimbatore', 'dp@domain.com'),
					 ('Emi', 'Kongu Engineering College â€“ Erode ', 'emi@domain.com'),
					 ('Raja', 'P.S.G. College of Technology', 'raja@domai.com'),
					 ('Sandra', 'University departments of Anna University Chennai ', 'san@domai.com');
				  ",$link);
	    	 
	 	if(!$res1)
		{
                    echo(" <table width=100% height=100% align=center><tr><td>
				<table bgcolor=#aaddaa align=center width=300 height=300><tr>
				<td style=\"color: #aa2233; font-size: 15px;\" align=center>
				 Unable to create tables.<br>");
		    echo("Your tables might have already been created.</td></tr></table> </td></tr></table>");
		    

		}
		else
                {
		  echo "<table align=center width=300 height=300>
       <tr>
           <td style=\"color: #aa2233; font-size: 15px;\" align=center>
                   HIOX DB Installation Manager
           </td>
       </tr>
       <tr bgcolor=#aaddaa>
           <td style=\"color: #000088; font-size: 14px; padding:10px;\">
                  You have succesfully installed the product.<br><br>
                  Do proceed to work with the product.<br>
                  <br>
                  This utility is provided by HIOX INDIA.<br><br>
                  For more details, visit <a href=\"http://www.hscripts.com\">hscripts.com</a>
		  <br>
		 
           </td>
       </tr>
    </table>";
		}
	}
	else
	{
		echo "inner else";
		$vv =false;
	}
   }
   else
   {
	echo "outer else";
	$vv =false;
   }


  
?>

<!-- Welcome to the scripts database of HIOX INDIA      -->
<!-- This tool is developed and a copyright             -->
<!-- product of HIOX INDIA.			        -->
<!-- For more information visit http://www.hscripts.com -->
