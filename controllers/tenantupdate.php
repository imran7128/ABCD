<?php
	include('config.php');
    include('session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $firstName = $_POST['fName'];
        $lastName = $_POST['lName'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $contactNumber = $_POST['contactNumber'];
        $guardianName = $_POST['guardianName'];
        $guardianAddress = $_POST['guardianAddress'];
        $guardianContact = $_POST['guardianContact'];
        $id = $_POST['id'];

        $sql = "UPDATE _tenantprofile SET 
        firstName = :firstName, 
        lastName = :lastName,
        address = :address,
        email = :email,
        contactNumber = :contactNumber,
        guardianName = :guardianName,
        guardianAddress = :guardianAddress,
        guardianContact = :guardianContact
        WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam("firstName",$firstName);
        $stmt->bindParam("lastName",$lastName);
        $stmt->bindParam("address",$address);
        $stmt->bindParam("email",$email);
        $stmt->bindParam("contactNumber",$contactNumber);
        $stmt->bindParam("guardianName",$guardianName);
        $stmt->bindParam("guardianAddress",$guardianAddress);
        $stmt->bindParam("guardianContact",$guardianContact);
        $stmt->bindParam("id",$id);
        $stmt->execute();
?>