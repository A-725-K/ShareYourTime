<?php
    require_once("connection.php");
    require_once("../utils/constant.php");
	
	$conn = connectionToDb();
    
    $queryCreateTable[0] = "CREATE TABLE ShareYourTagsTime (
                    Tag char(".TagMaxLength.") PRIMARY KEY
				);";

    $queryCreateTable[1] = "CREATE TABLE ShareYourUsersTime (
                    User char(".UserNameMaxLength.") PRIMARY KEY,
                    Password char(".PasswordMaxLength.") NOT NULL,
                    Name char(".NameMaxLength.") NOT NULL,
                    Surname char(".SurnameMaxLength.") NOT NULL,
                    Phone char(".PhoneLength.") NOT NULL UNIQUE,
                    Email char(".EmailMaxLength.") NOT NULL UNIQUE,
                    Street char(".StreetMaxLength.") NOT NULL,
                    Photo char(".PhotoMaxLength.") NOT NULL
                );";

    $queryCreateTable[2] = "CREATE TABLE ShareYourJobsTime (
                    IdJob int PRIMARY KEY auto_increment,
                    Description char(".DescriptionMaxLength.") NOT NULL,
                    Cost int NOT NULL,
                    TimeStart datetime NOT NULL,
                    TimeEnd datetime NOT NULL,
                    Distance int NOT NULL,
                    Evaluation int default 0,
                    Street char(".StreetMaxLength.") NOT NULL,
                    Latitude float NOT NULL,
					Longitude float NOT NULL,
					Proposer char(".UserNameMaxLength.") NOT NULL,
					Receiver char(".UserNameMaxLength.") default NULL,
					Tag char(".TagMaxLength.") NOT NULL,
                    FOREIGN KEY (Tag) REFERENCES ShareYourTagsTime (Tag) ON UPDATE CASCADE ON DELETE CASCADE,
                    FOREIGN KEY (Receiver) REFERENCES ShareYourUsersTime (User) ON UPDATE CASCADE ON DELETE CASCADE,
                    FOREIGN KEY (Proposer) REFERENCES ShareYourUsersTime (User) ON UPDATE CASCADE ON DELETE CASCADE
                );";
	
	$queryCreateTable[3] = "CREATE TABLE ShareYourPvtMsgTime (
                   	IdMsg int PRIMARY KEY auto_increment,
					Text char(".MsgMaxLength.") NOT NULL,
					Obj char(".ObjMaxLength.") NOT NULL,
					Sender char(".UserNameMaxLength.") NOT NULL,
					Receiver char(".UserNameMaxLength.") NOT NULL,
					Date datetime NOT NULL,
					ReadYet BOOLEAN default FALSE NOT NULL,
                    FOREIGN KEY (Sender) REFERENCES ShareYourUsersTime (User) ON UPDATE CASCADE ON DELETE CASCADE,
                    FOREIGN KEY (Receiver) REFERENCES ShareYourUsersTime (User) ON UPDATE CASCADE ON DELETE CASCADE
     			);";

    foreach($queryCreateTable as $query ){     

        if ( !($prepared_stmt = mysqli_prepare($conn, $query)) )
            die ("<br>Errore creazione tabella !");
        
        if ( !mysqli_stmt_execute($prepared_stmt) ) 
            die ("Impossibile eseguire l'operazione richiesta !<br>");
                        
        echo("<br>Tabella creata con successo !");
        mysqli_stmt_close($prepared_stmt);    
    }       
        

    mysqli_close($conn);        

