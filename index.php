<html>
    <head>
        <title>PHP Mysql Pagination Script</title>
        <link href="css/numericPagination.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
        include 'config.php';
        $conn=mysql_connect("$hostname","$username","$password") or die(mysql_error());
        $db=mysql_select_db("$dbname",$conn) or die(mysql_error());
        include 'commonPaginationClass.php';
        $paginations=new CmnPagination();
        $count1=mysql_query("select * from paginations");
        $count =mysql_numrows($count1);
        if(isset($_GET['page']))
            $page=$_GET['page'];
        else
            $page=1;
        $limit=5;
        $total_page=$count; /* total page is count of table row */       
        $targetPage="index.php?";
        $symbol=""; //symbol is or query string. if you have already query string in target page then here set "&"
        $first_term = 0;
        if ($page == 1) {
            $start = $first_term;
        } else {
            $start = $first_term + ($page - 1) * $limit;
        }
        if (!is_numeric($start)) {
            $start = 0;
        }
        $scripts=$paginations->getpageinfo($start,$limit);
        
        ?>
        <div align="center" class='resp_code'>
            <center><b>PHP Mysql Pagination Script</b></center>
            <table width='90%' align='center' class="table">
                <tr>
                    <th>S.no</th>
                    <th>Name</th>
                    <th>Collage</th>
                    <th>Email</th>
                </tr>
                    <?php
                    if(count($scripts)>0)
                    {
                        $i=1;
                        $scripts=array_filter($scripts);
                        foreach($scripts as $scripts)
                        {
                        ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $scripts['name'];?></td>
                                <td><?php echo $scripts['collage'];?></td>
                                <td><?php echo $scripts['email'];?></td>
                            </tr>
                        <?php
                        $i++;
                        }
                    }
                    ?>
            </table>
        </div>
        <?php echo $paginations->numericPage($page,$limit,$total_page,$targetPage,$symbol);?>
        <div id="dumdiv" align="center" style=" font-size: 10px;color: #dadada;">
            <a id="dum" style="padding-right:0px; text-decoration:none;color: #dadada;" href="http://www.hscripts.com">©h</a>
        </div>
    </body>
</html>



