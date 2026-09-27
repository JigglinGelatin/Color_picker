<?php
	//Declares and assigns search result, search count and input variables
	$inData = getRequestInfo();
	
	$searchResults = "";
	$searchCount = 0;
	//Tests SQL connection and handles failure
	$conn = new mysqli("localhost", "DB_User", "DB_Pass", "Database");
	if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	} 
	else
	{
		$stmt = $conn->prepare("select Name from Colors where Name like ? and UserID=?");
		$colorName = "%" . $inData["search"] . "%";
		$stmt->bind_param("ss", $colorName, $inData["userId"]);
		$stmt->execute();
		
		$result = $stmt->get_result();
		
		while($row = $result->fetch_assoc())
		{
			if( $searchCount > 0 )
			{
				$searchResults .= ",";
			}
			$searchCount++;
			$searchResults .= '"' . $row["Name"] . '"';
		}
		
		if( $searchCount == 0 )
		{
			returnWithError( "No Records Found" );
		}
		else
		{
			returnWithInfo( $searchResults );
		}
		
		$stmt->close();
		$conn->close();
	}
	//Gets information from request
    function getRequestInfo()
    {
        return json_decode(file_get_contents('php://input'), true);
    }
	//Sends back formatted data
    function sendResultInfoAsJson( $obj )
    {
        header('Content-type: application/json');
		echo $obj;
    }
    //Returns formatted errors 
    function returnWithError( $err )
    {
        $retValue = '{"id":0,"firstName":"","lastName":"","error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
    }
    //Returns formatted info
    function returnWithInfo( $firstName, $lastName, $id )
	{
        $retValue = '{"results":[' . $searchResults . '],"error":""}';
		sendResultInfoAsJson( $retValue );
    }
    
?>