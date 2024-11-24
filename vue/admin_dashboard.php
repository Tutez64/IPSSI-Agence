<?php
ob_start();

$column_names = array();
echo '<h1>Gérez les ' . $name . '</h1>'
?>
    <div class="table-responsive">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
				<?php
				$_SESSION['table'] = $table;
				$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='$table';";
				$res = $userMdl->executeReq($query);
				while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
					$column_names[] = $row['COLUMN_NAME'];
					echo '<th scope="col">' . $row['COLUMN_NAME'] . '</th>';
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
				echo '<tr> <th scope="row">' . $row['id'] . '</th>';
				foreach ($column_names as $column) {
					echo '<td> ' . $row[$column] . '</td>';
				}
				echo '<td><button type="button" onclick="passID('.$row['id'].', \''.$table.'\')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delModal">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg>
</button></td>';
				echo '</tr>';
			}
			?>
            </tbody>
        </table>
    </div>
<script>
    function passID(id, table){
        var button = document.getElementById("del_entry");
        button.value = id;
        var button1 = document.getElementById("table");
        button1.value = table;
    }
</script>

    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addModal"
            style="margin: 10px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square"
             viewBox="0 0 16 16">
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
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
					<?php include "add_entry.php" ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header position-relative pb-0">
                    <h1 class="modal-title fs-1 luckiest" id="menu-modal-label">Supprimer l'élément ?</h1>
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="table" name="table"/>
                    <button type="submit" name="del_entry" id="del_entry" class="btn btn-danger">Confirmer</button>
                </div>
            </div>
        </div>
    </div>
<?php
$contenu = ob_get_clean();
include "template.php";
