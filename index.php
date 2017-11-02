<?php
    //Sukuriamas duomenų bazės ryšys
    $database = mysqli_connect('localhost', 'root', '', 'lab3') or die ('Negaliu prisijungti prie MySQL: ' . mysqli_error() );

    //Išrenkami visi duomenys iš lentelės
    $query = 'SELECT * from rokaspalionis';
    $result = @mysqli_query ($database, $query);

	//Paspaustas įvedimo mygtukas
	if(!empty($_POST['submit'])) {
        echo "Data has been submitted!";
        
        $queryPost = "INSERT INTO rokaspalionis (data, ip, vardas, epastas, zinute)
	                   VALUES ('".date('Y/m/d h:i:s a', time())."', '".getHostByName(getHostName())."', '".$_POST['vardas']."', '".$_POST['epastas']."', '".$_POST['zinute']."')";
        
        if(@mysqli_query ($database, $queryPost)) {
            echo "Succesful submission of data!";
            header("location:index.php");
        }
        else {
            echo "Failed submitting data!";
        }
	}

    mysqli_close($database);

	$fields = array();
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Vardas</th>
                <th>E-paštas</th>
                <th>Data (ip adresas)</th>
                <th>Tekstas</th>
            </tr>
        </thead>
        <tbody>

<?php

while ($row = mysqli_fetch_array($result)) {
	$fields[] = $row;
}

foreach($fields as $key => $value) {
  echo "<tr><td>".$value["vardas"]."</td>".
		"<td>".$value["epastas"]."</td>".
		"<td>".$value["data"]." (".$value["ip"].")</td>".
		"<td>".$value["zinute"]."</td></tr>";
}

?>

        </tbody>
    </table>
	
    <form action="" method="post">
        <div class="form-group">
            <label for="vardas">Vardas</label>
            <input type="text" class="form-control" name="vardas" required>
        </div>
        <div class="form-group">
            <label for="epastas">E-paštas</label>
            <input type="email" class="form-control" name="epastas" required>
        </div>
        <div class="form-group">
            <label for="zinute">Tekstas</label>
            <textarea class="form-control" rows="3" name="zinute" required></textarea>
        </div>
        <input class="btn btn-default" type="submit" name="submit" value="Siųsti"/>
		
    </form>

</body>
</html>