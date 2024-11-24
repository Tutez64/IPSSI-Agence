<?php
ob_start();

$column_names = array();
echo '<h1>Gérez les '.$name.'</h1>'
?>
    <div class="table-responsive">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <?php
                $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='$table';";
                $res = $userMdl->executeReq($query);
                while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                    $column_names[] = $row['COLUMN_NAME'];
                    echo '<th scope="col">'.$row['COLUMN_NAME'].'</th>';
                }
                ?>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            <?php
            $query = "SELECT * FROM $table;";
            $res = $userMdl->executeReq($query);
            array_shift($column_names);
            while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr> <th scope="row">'.$row['id'].'</th>';
                foreach ($column_names as $column) {
                    echo '<td> '.$row[$column].'</td>';
                }
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
<?php
$contenu = ob_get_clean();
include "template.php";
