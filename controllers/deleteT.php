<?php
	include('config.php');
    include('session.php');
    $conn = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if(isset($_POST['tid'])){
        $tenant_selected_id = $_POST['tid'];
        $sql = "SELECT uid FROM _tenantrentinginformation WHERE tid = '".$tenant_selected_id."'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $sql = "DELETE FROM _tenantrentinginformation WHERE tid = '".$tenant_selected_id."'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql = "SELECT currentTenant FROM _unit WHERE id = '".$result['uid']."'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $currentTenant = $stmt->fetch(PDO::FETCH_ASSOC);

        $sql = "UPDATE _unit SET currentTenant = :currentTenant WHERE id = '".$result['uid']."'";
        $stmt = $conn->prepare($sql);
        $currentTenant['currentTenant'] -= 1;
        $stmt->bindParam("currentTenant", $currentTenant['currentTenant']);
        $stmt->execute();

        $sql = "SELECT id FROM _bill WHERE  tid = '".$tenant_selected_id."'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $sql = "DELETE FROM _bill_items WHERE bid = '".$result['id']."'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }

        $sql = "DELETE FROM _bill WHERE tid = '".$tenant_selected_id."'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql = "DELETE FROM _payments WHERE tid = '".$tenant_selected_id."'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

    }
?>