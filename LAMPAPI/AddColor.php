<?php
	//Declares and assigns color,userid and request info variables
    $inData = getRequestInfo();
	
	$color = $inData["color"];
	$userId = $inData["userId"];

	$conn = new mysqli("localhost", "DB_User", "DB_Pass", "Database");
	//Tests SQL connection and handles failure
    if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	} 
	else
	{
		$stmt = $conn->prepare("INSERT into Colors (UserId,Name) VALUES(?,?)");
		$stmt->bind_param("ss", $userId, $color);
		$stmt->execute();
		$stmt->close();
		$conn->close();
		returnWithError("");
	}
	//Get request function
    function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}
	//Send result function
	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
	//Error returning function
	function returnWithError( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
?>