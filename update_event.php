<?php
include('db_connection.php');
session_start();
if (count($_POST) > 0) {
    $Nom = $_POST['Nom'];
        $Date = $_POST['Date'];
        $Description = $_POST['Description'];
        $Priorité_ID = $_POST['priorités'];
        $id = $_POST['id'];
    $query = "UPDATE `événements` SET `Nom`='$Nom',`Date`='$Date',`Description`='$Description',`Priorité_ID`='$Priorité_ID'  WHERE  `ID` Like '$id'";
    if (!$conn->query($query)) {
        $_SESSION['error'] = "Error description: " . $mysqli->error;
        unset($_SESSION['succes']);
        header('Location: evenements.php');
    } else {
        $_SESSION['succes'] = "la mise à jour réussie";
        unset($_SESSION['error']);
        header('Location: evenements.php');
    }
}
$result = mysqli_query($conn, "SELECT  * FROM événements WHERE ID='" . $_GET['id_edit'] . "'");
$row = mysqli_fetch_array($result);
?>
<html>

<head>
    <title>Actualiser l'event</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container px-5 my-5">
        <div class="card shadow-sm p-3 mb-5 bg-body rounded">
            <div class="row">
                <div class="col">
                    <div >
                        <a class="link-offset-2 link-underline link-underline-opacity-0 " href="evenements.php"> <i
                                class="bi bi-arrow-counterclockwise"></i>retour</a>
                    </div>

                </div>
            </div>
            <form method="post" action="" class="mt-3" enctype="multipart/form-data">
                <div class=" form-group" style="display: none;">
                    <label for="id"> id du produit:</label>
                    <input type="text" class="form-control" name="id" id="id" value="<?php echo $row['id']; ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="Date">Nom:</label>
                    <input type="text" class="form-control" name="Nom" id="Nom" value="<?php echo $row['Nom']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="Date">Date:</label>
                    <input type="date" class="form-control" name="Date" id="Date" value="<?php echo $row['Date']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="priorités">priorités:</label>

                    <select name="priorités" id="priorités" class="form-control" value="<?php echo $row['Priorité_ID']; ?>" required>
                        <option>choisisser votre category</option>
                        <?php
                        $query = "SELECT * FROM `priorités`";
                        $priorites = mysqli_query($conn, $query);
                        if (mysqli_num_rows($priorites) > 0) {
                            while ($row1 = mysqli_fetch_assoc($priorites)) {
                                echo "<option value=" . $row1["ID"] . ">" . $row1["Nom"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Description">Description:</label>
                    <input type="text" class="form-control" name="Description" value="<?php echo $row['Description']; ?>" id="Description" required>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" name="submitup" class="btn btn-success mt-3">éditer Produit</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>