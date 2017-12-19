<?php
$file = "config.php"; 
if(!is_readable($file) or !is_writeable($file))
{
  echo " <span class=\"errortext\">Incorrect file permissions for config.php! <br>Must be in read,write mode during installaton</span>"; 
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $username = $_POST['username'];
  $password = $_POST['pass'];
  $hostname = $_POST['hostname'];
  $dbname = $_POST['dbname'];
  //open config.php and write the data in to it.
  $open = fopen($file, "w");
  fwrite($open,"<?php\n\n \$username = \"".$username."\";\n \$password = \"".$password."\";\n \$hostname = \"".$hostname."\";\n \$dbname = \"".$dbname."\";\n\n ?>");
  fclose($open);
  include "create.php";
}
else{
   if(filesize($file)!=0){
      //echo "You have already installed the product.<br>Reinstalling may affect your DB Configuration.";
   }
?>

<table align=center height=100% width=100%>
   <tr>
      <td>
          <table bgcolor=adeade align=center style="border: 1px #266266 solid;">
          <tr width=400 height=20>
              <td align=center bgcolor="266266" style="color: ffffff; font-family: arial,verdana,san-serif; font-size:13px;">
                  Enter Database Details 
              </td>
          </tr>
          <tr width=400 height=20>
              <td>
                  <form name=setf method=POST action="install.php">
                    	<table style="color:#121212; font-family: arial,verdana,san-serif; font-size:13px;">
	                    <tr>
                                <td>HOST NAME </td>
                                <td><input class="ta" name="hostname"  type=text></td>
                            </tr>
     	                    <tr>
                                <td>DB NAME </td>
                                <td><input class="ta" name="dbname"  type=text></td>
                            </tr>
 	                    <tr>
                                <td>User NAME </td>
                                <td><input class="ta" name="username"  type=text></td>
                            </tr>
 	                    <tr>
                                <td>Password </td>
                                <td><input class="ta" name="pass"  type=text></td>
                            </tr>
   	                         </td></tr>
	                    <tr>
                                <td></td>
                                <td><input type=submit value="Install"></td>
                            </tr>
	                </table>
                  </form>
               </td>
           </tr>
        </table>

      </td>
   </tr>
</table>
<?php
}
?>
