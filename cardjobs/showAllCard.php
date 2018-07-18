<?php
        
    function showJobs($getJobsQuery, $selector) {
        require_once('../db/connection.php');
        
        
        $conn = connectionToDb();
        
        if ( !($res = mysqli_query($conn, $getJobsQuery)) ) 
            die('Errore nella selezione dei lavori');

        $rows=mysqli_num_rows($res);
?>

    <div class="card-columns">
        <?php
            require_once("singleCard.php");
            if($rows>0){
                while( $row = mysqli_fetch_array($res) ) 
                    showCart($row,$selector);
            }else{
        ?> 
            <h1>NON CI SONO LAVORI</h1>
        <?php } ?>    
    </div>
<?php } ?>