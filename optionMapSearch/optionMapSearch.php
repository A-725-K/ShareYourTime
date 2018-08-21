
<div class="row">
    <div class="col-md-3"> 
        <input id="optionMapStreet" onfocusin="cleanErr('errStreetSearch')" class="mySelection" placeholder="Inserisci la via" name="optionMapStreet">
        <p id="errStreetSearch"></p>
    </div>
    
    <div class="col-md-3"> 
        <select class="custom-select mySelection" onfocusin="cleanErr('errDistanceSearch')" id="optionMapDistance" name="optionMapDistance">
            <option selected disabled>Seleziona la distanza</option>
            <?php
                for($i = 1; $i < 10; $i++)
                    echo '<option value='.'"'.($i).'">'.($i).' Km</option>';
                for($i = 1; $i < 6; $i++)
                    echo '<option value='.'"'.($i*10).'">'.($i*10).' Km</option>';
            ?>
        </select>
        <p id="errDistanceSearch"></p>
    </div>

    <div class="col-md-3"> 
        <select class="custom-select mySelection" id="optionMapCost" name="optionMapCost">
        <option selected disabled>Seleziona il costo</option>
        <?php
            for($i = 1; $i < 10; $i++)
                echo '<option value='.'"'.($i*5).'">'.($i*5).' Euro</option>';
            for($i = 1; $i < 10; $i++)
                echo '<option value='.'"'.($i*50).'">'.($i*50).' Euro</option>';
            for($i = 1; $i < 10; $i++)
                echo '<option value='.'"'.($i*500).'">'.($i*500).' Euro</option>';
        ?>
        </select>
    </div>
    
    <div class="col-md-3"> 
        <select class="custom-select mySelection" id="optionMapTag" name="optionMapTag">
        <option selected disabled>Scegli il tag</option>
        <?php
            require_once('../db/connection.php');

            $getJobsQuery = "SELECT Tag FROM ShareYourTagsTime ORDER BY Tag ASC;";
            $conn = connectionToDb();
            
            if ( !($res = mysqli_query($conn, $getJobsQuery)) ) 
                die('Errore nella selezione dei lavori');

            while( $row = mysqli_fetch_array($res) ) 
                echo '<option>'.$row['Tag'].'</option>';

			mysqli_free_result($res);
			mysqli_close($conn);
        ?>	
         </select>
    </div>
</div>
<div class ="row">
    <div class=" offset-md-5 col-md-2"> 
        <button type="button" class="btn btn-secondary mb-2" id="myButtonSearchMap" onClick="checkOptionSearchMap()">
            <i class="fas fa-search"></i>
            Cerca
        </button>
    </div>
</div>
