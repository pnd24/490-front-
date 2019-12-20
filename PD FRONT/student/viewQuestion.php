<?php


require  "config.php";
require  "connect.php";

$formData = file_get_contents("php://input");
$data = json_decode($formData);


if($data->request == "viewQuestion")
{
	if ($db === false)
	{
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}

	$result = $db->query("SELECT * FROM questionBank") or die($db->error);

	$questionArray = array();

	while ($row = $result->fetch_object())
	{
		$questionArrayTemp = array( "id" => $row->id,
														"category" => $row->category,
                            "questionName" => $row->questionName,
                            "questionActual" => $row->questionActual,
                            "constraints" => $row->constraints,
                            "difficulty" => $row->difficulty);
		array_push($questionArray,$questionArrayTemp);


	}

	echo json_encode($questionArray);



	mysqli_close($db);
}
