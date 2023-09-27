<?php include('menu.php');
?>
<div class="container ">
    <div class="row center">
        <div class="col-md-6">
            <form method="post" action="evenements.php" class="mt-3" enctype="multipart/form-data">
                
                <div class=" form-group">
                    <label for="Nom">Nom:</label>
                    <input type="text" class="form-control" name="Nom" id="Nom" required>
                </div>
                <div class="form-group">
                    <label for="Date">Date:</label>
                    <input type="date" class="form-control" name="Date" id="Date" required>
                </div>
                <div class="form-group">
                    <label for="priorités">priorités:</label>

                    <select name="priorités" id="priorités" class="form-control" required>
                        <option>choisisser votre category</option>
                        <?php
                        $sql1 = "SELECT * FROM `priorités`";
                        $region = mysqli_query($conn, $sql1);
                        if (mysqli_num_rows($region) > 0) {
                            while ($row = mysqli_fetch_assoc($region)) {
                                echo "<option value=" . $row["ID"] . ">" . $row["Nom"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Description">Description:</label>
                    <input type="text" class="form-control" name="Description" id="Description" required>
                </div>
                
                <div class="form-footer">

                    <button type="submit" name="submit" class="btn btn-success mt-3">Ajoute</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>