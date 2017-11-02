<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
     </script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
     </script>
	
</head>


<style>
#atsiliepimai {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 70%;}
#atsiliepimai td {
    border: 1px solid #ddd;
    padding: 8px;}
#atsiliepimai tr:nth-child(even){background-color: #f2f2f2;}
#atsiliepimai tr:hover {background-color: #ddd;}
</style>

<center><h3>Atsiliepimų knyga</h3></center>
<table style="margin: 0px auto;" id="atsiliepimai">



<?php
		$dbc=mysqli_connect('localhost','stud', 'stud','stud');
		if(!$dbc){
			die ("Negaliu prisijungti prie MySQL:"	.mysqli_error($dbc));
		}
	$sql = "SELECT * FROM KarolisKuzmickas";
    $result = mysqli_query($dbc, $sql);
	echo "<table border=\"1\">";
	{while($row = mysqli_fetch_assoc($result))
		{
		echo "<tr><td>".$row['id']." </td><td>".$row['vardas']."</td><td>".$row['epastas']."</td><td>".$row['data']."</td><td>(".$row['ip'].")</td><td>".$row['zinute']."</td><td>".$row['Telefono_nr']."</td></tr>";
		} 
    };
	echo "</table>";
?>

<div class="container">
  <form method='post'>
     <div class="form-group col-lg-4">
          <label for="vardas" class="control-label">Vardas:</label>
          <input name='vardas' id='vardas' type='text' class="form-control input-sm">
     </div>
     <div class="form-group col-lg-4">
          <label for="epastas" class="control-label">e-pastas:</label>
          <input name='epastas' id="epastas" type='email' class="form-control input-sm">
     </div>
	 <div class="form-group col-lg-4">
          <label for="Telefono_nr" class="control-label">Telefono nr:</label>
          <input name='Telefono_nr' id="Telefono_nr" type='text' class="form-control input-sm">
     </div>
     <div class="form-group col-lg-12">
          <label for="zinute" class="control-label">tekstas:</label>
          <textarea name='zinute' class="form-control input-sm"></textarea>
     </div>
     <div class="form-group">
         <input type='submit' name='ok' value='siusti' class="btnbtn-default">
     </div>
	  <div class="form-group col-lg-4">
          <label for="id" class="control-label">Iveskite eilutes id, kad ja panaikinti:</label>
          <input name='id' id='id' type='text' class="form-control input-sm">
     </div>
     <div class="form-group">
         <input type='submit' name='ok' value='panaikinti' class="btnbtn-default">
     </div>
 </form>
</div>

<?php
if($_POST !=null && $_POST['vardas'] != '' && $_POST['epastas'] != ''){
	
	$ip = $_SERVER['SERVER_ADDR'];
	$data = date('Y-m-d H:i:s');
	$vardas = $_POST['vardas'];
	$epastas =$_POST['epastas'];
	$Telefono_nr =$_POST['Telefono_nr'];
	$zinute = $_POST['zinute'];
	$sql = "INSERT INTO KarolisKuzmickas (ip, data, vardas, epastas, zinute, Telefono_nr) VALUES ('$ip','$data', '$vardas', '$epastas','$zinute', '$Telefono_nr')";
	header("location:index.php");
    if (mysqli_query($dbc, $sql)) echo "Įrašyta";	else die ("Klaida irasant: "	.mysqli_error($dbc));
	}
if($_POST !=null && $_POST['id'] != ''){
	
	$id= $_POST['id'];
	$sql="DELETE FROM KarolisKuzmickas WHERE id='$id'";
	
	header("location:index.php");
	if (mysqli_query($dbc, $sql)) echo "Panaikinta";	else die ("Klaida panaikinant: "	.mysqli_error($dbc));
}
