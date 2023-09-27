<?php include('menu.php');
session_start();
if (isset($_GET["id_delet"])) {
    $id = $_GET["id_delet"];
    $query = "DELETE FROM `événements` WHERE `ID`='$id'";
    $conn->query($query);
    header('Location: evenements.php');
    $_SESSION['succes'] = "la suppression est réussie";
}
function addevent($Nom, $Date, $Description, $Priorité_ID)
{
    global $conn;
    $sql = "INSERT INTO `événements`(`Nom`, `Date`, `Description`, `Priorité_ID`) 
    VALUES ('$Nom','$Date','$Description','$Priorité_ID')";
    $conn->query($sql);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $Nom = $_POST['Nom'];
        $Date = $_POST['Date'];
        $Description = $_POST['Description'];
        $Priorité_ID = $_POST['priorités'];
        if (empty($Nom) || empty($Date) || empty($Description) || empty($Priorité_ID)) {
            echo 'erroe insertion';
        }else {
            addevent($Nom, $Date, $Description, $Priorité_ID);
        }
        header('Location: evenements.php');
        exit();
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <h2 class="h5 mt-4 mb-4 text-center">tableaux des evenments</h3>
                <div class="row position-relative">
                    <div class="col-12 mb-4">
                        <?php if (isset($_SESSION['error'])) { ?>
                            <div class="alert text-center alert-danger" role="alert">
                                <?php echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                ?>
                            </div>
                            <?php } 
                         if (isset($_SESSION['succes'])) { ?>
                            <div class="alert text-center alert-success" role="alert">
                                <?php echo $_SESSION['succes'];
                                unset($_SESSION['error']);
                                ?>
                            </div>
                        <?php }?>
                        
                    </div>
                </div>
                <div class="card">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Date</th>
                                <th scope="col">Priorité</th>
                                <th scope="col">Description</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Query fetch products
                            $sql = "SELECT * FROM événements";
                            $stmt = $conn->query($sql);

                            while ($events = $stmt->fetch_assoc()) {
                                ?>
                                <tr class="alert" role="alert">
                                    <td>
                                        <?php echo $events['Nom']; ?>
                                    </td>
                                    <td>
                                        <?php echo $events['Date']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $id = $events['Priorité_ID'];
                                        $query = "SELECT * from priorités WHERE ID=$id";
                                        $res = mysqli_query($conn, $query);
                                        $priorites = mysqli_fetch_row($res);
                                        if (!empty($priorites)) {
                                            echo $priorites[1];
                                        } else {
                                            echo "";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $events['Description']; ?>
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class="bi bi-mouse3"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item link-danger"
                                                        href="update_event.php?id_edit=<?php echo $events['ID']; ?> "><i
                                                            class="bi bi-pencil-square"></i> éditer</a></li>
                                                <li><a class="dropdown-item link-warning"
                                                        href="evenements.php?id_delet=<?php echo $events['ID']; ?> "><i
                                                            class="bi bi-trash3"></i> supprimer</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>
</body>

</html>