<?php
    
    require_once("connection.php");
    $conn = connectionToDb();
    
    $queryDeleteTable[0] =  "DROP TABLE ShareYourJobsTime";
    $queryDeleteTable[1] =  "DROP TABLE ShareYourPvtMsgTime";
    $queryDeleteTable[2] =  "DROP TABLE ShareYourTagsTime";
    $queryDeleteTable[3] =  "DROP TABLE ShareYourUsersTime";

    foreach($queryDeleteTable as $query )  {   
        
        if ( !($prepared_stmt = mysqli_prepare($conn, $query)) ) 
            die ("Tabella non rimossa !<br>");
        if ( !mysqli_stmt_execute($prepared_stmt) )
            die ("<br>Impossibile eseguire l'operazione richiesta !");
                                
        echo("Tabella rimossa con successo !<br>");

        mysqli_stmt_close($prepared_stmt);
                   
    }          
    mysqli_close($conn);        
