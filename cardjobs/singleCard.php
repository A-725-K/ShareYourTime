<?php
  
    function showCard($row)  {
?>
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <h5 class="card-title"><li class="list-group-item p-0 m-0 h3em" id="cardDescription_<?php echo $row['IdJob']?>" value="<?php echo $row['Description']?>" ><?php echo $row['Description']?></li></h5>
                    <li class="list-group-item" id="cardCost_<?php echo $row['IdJob']?>" value="<?php echo $row['Cost']?>"><?php echo "Costo : ".$row['Cost']?></li>
                    <li class="list-group-item" id="cardTimeStart_<?php echo $row['IdJob']?>" value="<?php echo $row['TimeStart']?>"><?php echo "Inizio : ".$row['TimeStart']?></li>
                    <li class="list-group-item" id="cardTimeEnd_<?php echo $row['IdJob']?>" value="<?php echo $row['TimeEnd']?>"><?php echo "Fine : ".$row['TimeEnd']?></li>
                    <li class="list-group-item" id="cardDistance_<?php echo $row['IdJob']?>" value="<?php echo $row['Distance']?>"><?php echo "Distanza : ".$row['Distance']?></li>
                    <?php if ( $_SESSION['page'] == "index" ||  $row['TimeEnd'] < date('Y-m-d H:i:s') ) {?>
                        <li class="list-group-item h3em" id="cardValuation_<?php echo $row['IdJob']?>" value="<?php echo $row['Evaluation']?>">
                            <?php 
                                //se il lavoro non ha valutazioni si da 
                                //la possibilità di valutare
                                //altrimenti si stampano le stelline 
                                //corrisponenti
                                if( $row['Evaluation'] == 0 ){
                                    if(  $_SESSION['page'] == "index" || $_SESSION['page'] == "viewjobs" )
                                        if ($_SESSION['page'] == "index" || $row['Receiver'] == null )
                                            echo "Nessuna valutazione";
                                        else
                                            echo "In attesa di valutazione";
                                    else    
                                        echo "Aggiungi una valutazione";
                                }else
                                    for($i=0; $i<$row['Evaluation']; $i++)
                                        echo "<i class='far fa-star'></i>";
                            ?>
                        </li>
                    <?php } ?>
                    <li class="list-group-item" id="cardStreet_<?php echo $row['IdJob']?>" value="<?php echo $row['Street']?>"><?php echo $row['Street']?></li>
                    <?php if ( $_SESSION['page'] == "index" || $_SESSION['page'] == "viewjobsrequired" || $_SESSION['page'] == "homepage" ) {?>
                        <li class="list-group-item" id="cardProposer_<?php echo $row['IdJob']?>" value="<?php echo $row['Proposer']?>">Proposto da: <?php echo $row['Proposer']?></li>
                    <?php } ?>
                    <?php if ( ( $_SESSION['page'] == "viewjobs" || $_SESSION['page'] == "homepage" ) && $row['Receiver'] != null ) {?>
                        <li class="list-group-item h2em" id="cardReciver_<?php echo $row['IdJob']?>" value="<?php echo $row['Receiver']?>">Richiesto da: <?php echo $row['Receiver']?></li>
                    <?php } ?>
                </ul>
            </div>
            
            <?php if ($_SESSION['page'] == "viewjobs" && $row['Receiver'] == null ) {?>
                <div class="card-footer">
                    <button type="button" onClick="fillModalFieldJobs('modalModify_<?php echo $row['IdJob']?>')" id="modalModify_<?php echo $row['IdJob']?>" class="btn btn-warning mr-5" data-toggle="modal" data-target="#jobsModal">Modifica</button>
                    <a href="#" id="modalDelete_<?php echo $row['IdJob']?>" class="btn btn-danger ">Cancella</a>
                </div>
            <?php } ?>
        </div>
<?php } ?>


