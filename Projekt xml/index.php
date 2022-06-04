<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nvidia Searcher</title>
    <style>
        body{
            background-color: #76B900;
            display:flex;
            flex-direction: column;
            flex-wrap: wrap;
            align-self: auto;
            gap: 10px;
        }
        form{
            
            width:50%;
            background-color:grey;
            color: #d1ebe4;
            padding: 15px;
            

        }
        #prvi{background-color:red;
                color:white;}
        
    

    </style>

</head>
<body>

<form action="index.php" method="post">
    Odaberite koju seriju nVIDIA grafičkih kartica želite ispisati <br>
    1000 series <input type="radio" id="1000" name="serija_grafi" value="1"><br>
    2000 series <input type="radio" id="2000" name="serija_grafi" value="2"><br>
    3000 series <input type="radio" id="3000" name="serija_grafi" value="3"><br>
    <input type="submit" value="submit" id="prvi">
</form>

<form action="index.php" method="post">
    <br>Upišite ime grafičke kartice<br>
    <input type="text" name="pretraga">
    <input type="submit" value="submit" name="drugi_submit">
</form>



    
</body>

</html>


<?php
    $xml = simplexml_load_file("lista_proizvoda.xml") or die ("can't load xml file");

#kategorizacija po seriji

    if (isset($_POST ['serija_grafi'])){
        $serija = $_POST ['serija_grafi'];
        
        if ($serija == 1){
            $key=0;
            echo"<br>Odabarli ste 1000 seriju";
            echo "<br> <br>";
           
            foreach($xml->series_10->gpu as $grafa_10){
                echo "<br>";
                $key+=1;
                echo $key. " | ". $grafa_10->model. " | ". $grafa_10->codename. " | ". $grafa_10->msrp. "$". " | ". "<br>";
                }
        }
        if ($serija == 2){
            $key=0;
            echo"<br>Odabarli ste 2000 seriju";
            echo "<br><br>";
            # 20 series 
            foreach($xml->series_20->gpu as $grafa_20){
                echo "<br>";
                $key+=1;
                echo $key. " | ". $grafa_20->model. " | ". $grafa_20->codename. " | ". $grafa_20->msrp. "$ <br>";
            }
        }

        if ($serija == 3){
            $key=0;
            echo"<br>Odabarli ste 3000 seriju";
            echo "<br><br>";
            
            foreach($xml->series_30->gpu as $grafa_30){
                echo "<br>";
                $key+=1;
                echo $key. " | ". $grafa_30->model. " | ". $grafa_30->codename. " | ". $grafa_30->msrp. "$ <br>";
            }
        }
    }   

#pretraga
    if (isset($_POST ['pretraga'])){
        $search_input = $_POST ['pretraga'];
        $key=0;
        foreach ($xml->xpath('//gpu') as $grafa){
            $ime_modela=$grafa->model;
        
            if (strpos(strtolower($ime_modela), strtolower($search_input))){
                echo "<br><br>";
                $key+=1;
                echo $key. " | ";
                echo $ime_modela. " | codename:". $grafa->codename.  " |   ". $grafa->msrp. "$ <br>";
            }

            
        
        }

    }
    
?>