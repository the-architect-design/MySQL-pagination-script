<?php
class CmnPagination
{
    /**
    *  FOr numeric pagination
    *  Arg - current page number, limit, total pages, adjacent, target page.
    **/
    public $commonPagination;  
    function numericPage($page,$limit,$total_pages,$targetpage,$sym)
    {
        $prev = $page - 1;                            //previous page is page - 1
        $next = $page + 1;                            //next page is page + 1
        $lastpage = ceil($total_pages/$limit);        //lastpage is = total pages / items per page, rounded up.
        $lpm1 = ($lastpage - 1);           
        $commonPagination = "";
        $adjacents=2;
        if($sym=="")
            $sym="";
        if($lastpage > 1)
        {
            $commonPagination .= "<div class='page_navigation clearfix'><ul>";
            if ($page > 1){
                $commonPagination.= "<li><a href=\"$targetpage".$sym."page=$prev\">Prev</a>";
            }
            if ($lastpage < 7 + ($adjacents * 2))    //not enough pages to bother breaking it up
            {
                for ($counter = 1; $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $commonPagination.= "<li><span class='page_navigation_active'>$counter</span></li>";
                    else
                        $commonPagination.= "<li><a href=\"$targetpage".$sym."page=$counter\" >$counter</a></li>";
                }
            }
            else if($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
            {
                if($page <= 1 + ($adjacents * 2))
                {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                    {
                        if ($counter == $page)
                            $commonPagination.= "<li><span class='page_navigation_active'>$counter</span></li>";
                        else
                            $commonPagination.= "<li><a href=\"$targetpage".$sym."page=$counter\">$counter</a></li>";
                    }
                    $commonPagination.= "<li>...</li>";
                    $commonPagination.= "<li><a href=\"$targetpage".$sym."page=$lpm1\">$lpm1</a></li>";
                    $commonPagination.= "<li><a href=\"$targetpage".$sym."page=$lastpage\">$lastpage</a></li>";
                }
                //in middle; hide some front and some back
                elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                {
                    $commonPagination.= "<li><a href=\"$targetpage".$sym."page=1\">1</a></li>";
                    $commonPagination.= "<li><a href=\"$targetpage".$sym."page=2\">2</a></li>";
                    $commonPagination.= "<li>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                    {
                        if ($counter == $page)
                            $commonPagination.= "<li><span class='page_navigation_active'>$counter</span></li>";
                        else
                            $commonPagination.= "<li><a href=\"$targetpage".$sym."page=$counter\">$counter</a></li>";
                        }
                    $commonPagination.= "<li >...</li>";
                    $commonPagination.= "<li><a href=\"$targetpage".$sym."page=$lpm1\">$lpm1</a></li>";
                    $commonPagination.= "<li><a href=\"$targetpage".$sym."page=$lastpage\">$lastpage</a></li>";
                }
                //close to end; only hide early pages
                else
                {
                    $commonPagination.= "<li><a href=\"$targetpage".$sym."page=1\">1</a></li>";
                    $commonPagination.= "<li><a href=\"$targetpage".$sym."page=2\">2</a></li>";
                    $commonPagination.= "<li >...</li>";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                    {
                        if ($counter == $page)
                            $commonPagination.= "<li><span class='page_navigation_active'>$counter</span></li>";
                        else
                            $commonPagination.= "<li><a href=\"$targetpage".$sym."page=$counter\">$counter</a></li>";
                    }
                }
            }
            if ($page < $counter - 1)
                $commonPagination.= "<li><a href=\"$targetpage".$sym."page=$next\">Next</a>";
            else
                $commonPagination.= "";
                
            $commonPagination.= "</ul></div>";
            
            return $commonPagination;
        }
    }
        
    /**
     *  FOr A-Z links pagination
     *  Arg - table name, table field name, format.
    **/
    function tagPage($current,$tableName,$field,$page,$limit,$count,$targetPath,$sym,$tagOrder)
    { 
        if($sym!='&' && $sym!='?' && $sym!="")
        {
               echo 'The variable $symbol should be "?" OR "&"';
        }
        else
        {
            if($sym=="") $sym="?";
            if($tagOrder=="" || $tagOrder=="asc")
                $tagOrder="asc";
            else
                $tagOrder="desc";

            $list=$this->getCharSet($tableName,$field);
            $list=array_map('strtoupper', $list);
            
            $commonPaginationTag="<div class='page_navigation clearfix'><ul>";
               if($current=="all" || $current=="")
                    $commonPaginationTag.="<li><span class='page_navigation_active'>All</span></li>";
                else
                    $commonPaginationTag.="<li><a href='".$targetPath.$sym."letter=all'>All</a></li>";
            foreach(range('A', 'Z') as $letter)
            {
                if(strtolower($letter)==$current)
                { 
                  $commonPaginationTag.="<li><span class='page_navigation_active'>".$letter."</span></li>";
                }
                else
                {
                    if(in_array($letter,$list))
                        $commonPaginationTag.="<li><a href='".$targetPath.$sym."letter=".strtolower($letter)."'>".$letter."</a></li>";
                    else
                        $commonPaginationTag.="<li><span class='page_navigation_inactive'>".$letter."</span></li>";
                }
            }
            $commonPaginationTag.="</ul></div><div class=clear></div>";
            
            $start=($page-1)*$limit;
            $tags=$this->getPresents(strtolower($current),$tableName,$field,$start,$limit,$tagOrder);
            $cnts=$tags[1];$tags=$tags[0];
            if(count($tags))
            {
                $commonPaginationTag.="<div class='common_tags clearfix'>";
                for($i=0;$i<count($tags);$i++)
                {
                    if($count)
                        $commonPaginationTag.="<a href='".$targetPath.$sym."tag=".str_replace(' ', '-', strtolower($tags[$i]))."'>".$tags[$i]." (".$cnts[$i].")</a>";
                    else
                        $commonPaginationTag.="<a href='".$targetPath.$sym."tag=".str_replace(' ', '-', strtolower($tags[$i]))."'>".$tags[$i]."</a>";
                }
                $commonPaginationTag.="</div>";
            }
            else
                $commonPaginationTag.="<div class='common_tags clearfix'><a>Tags Not Found !!!</a></div>";

            $commonPaginationTag.="<div class=clear></div>".$this->numericPage($page,$limit,$this->getPresentsCount(strtolower($current),$tableName,$field,$total_page=true,''),$targetPath.$sym."letter=".strtolower($current),"&");
            
            return $commonPaginationTag;
        }
        
    }   
    function getPresentsCount($letter,$tableName,$field,$total_page,$tag)
    {
        if($total_page)
        {
            if($letter=="all")
            { 
                $Query="select count(distinct($field)) from $tableName";
                $result=mysql_query($Query) or die(mysql_error());
                return mysql_result($result,0);
            }
            else
            { 
                $Query="select count(distinct($field)) from $tableName where $field like '$letter%'";
                $result=mysql_query($Query); 
                return mysql_result($result,0);
            }
        }
        else
        {
            $arr=array();
            $tag=$this->sanitateArray($tag);
            $tag=implode(",",$tag);echo $tag;
            $Query="select count($field) from $tableName where $field IN ($tag)";
            $result=mysql_query($Query);echo mysql_error();
            while($row=mysql_fetch_array($result))
            {
                $arr[]=$row[0]; 
            }
            return $arr;
        }
    }
    
    function getPresents($letter,$tableName,$field,$page,$limit,$tagOrder)
    {
        $arr=array();$arr1=array();
        if($letter=="all")
            $Query="select distinct($field),count($field) from $tableName group by $field order by $field $tagOrder limit $page, $limit";
        else
            $Query="select distinct($field),count($field) from $tableName where $field like '$letter%' group by $field order by $field $tagOrder limit $page, $limit";
        $result=mysql_query($Query) or die(mysql_error());
        while($row=mysql_fetch_array($result))
        {
            $arr[]=$row[$field];
            $arr1[]=$row[1];
        }

        return array($arr,$arr1);
    }
    function getCharSet($tableName,$field)
    {
        $arr=array();
        $Query="select distinct LEFT($field,1) from $tableName where SUBSTR($field,1,1) REGEXP '[a-z]'";
        $result=mysql_query($Query) or die(mysql_error());
        while($row=mysql_fetch_array($result))
        {
            $arr[]=$row["LEFT($field,1)"];
        }
        return $arr;
    }
    function sanitateArray($array) {
       foreach($array as $key=>$value) {
          if(is_array($value)) { sanitate($value); }
          else { $array[$key] = mysql_real_escape_string($value); }
       }
       return $array;
    }
    function getpageinfo($start,$limit)
    {    
        $qryscripts=mysql_query("select * from paginations limit $start,$limit");
        while($result[]=mysql_fetch_array($qryscripts));       
        return $result; 
    }
}
?>
