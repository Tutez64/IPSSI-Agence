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
    <button type="button" class="btn btn-secondary"  data-bs-toggle="modal" data-bs-target="#addModal" style="margin: 10px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
        </svg>
        Ajouter un élément
    </button>

    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header position-relative pb-0">
                    <h1 class="modal-title fs-1 luckiest" id="menu-modal-label">Ajouter un élément</h1>
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
					<?php include "add_entry.php" ?>
                </div>
            </div>
        </div>
    </div>
<?php
$contenu = ob_get_clean();
include "template.php";
