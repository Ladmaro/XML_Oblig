<!--skrevet av Tom Andreas Krane Vingås-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.min.css">
    <title>VisitVaranger | 
        <?php if(!isset($_GET['page'])){
            echo'Opplev Vilmarken'; 
            }else{
                echo $_GET['page'];
            }?>
    </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"
      integrity="sha512-M2wvCLH6DSRazYeZRIm1JnYyh22purTM+FDB5CsyxtQJYeKq83arPe5wgbNmcFXGqiSH2XR8dT/fJISVA1r/zQ=="
      crossorigin=""/>
</head>
<body>
    <div class="container-content">
        <div class="row center-xs center-sm center-md center-lg ">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="header">
                    <h1>VisitVeranger</h1>
                </div>
            </div>
        </div>