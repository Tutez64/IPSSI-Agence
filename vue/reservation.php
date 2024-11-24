<?php
ob_start();
$column_names = array();
echo '<h1>Réservez votre prochain trajet !</h1>'
?>
<div class="table-responsive">
	<table class="table table-striped table-hover ">
		<thead>
		<tr>
			<?php
			$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='Vehicle' AND COLUMN_NAME != 'id';";
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
		$query = "SELECT * FROM Vehicle;";
		$res = $userMdl->executeReq($query);
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
			foreach ($column_names as $column) {
				echo '<td> ' . $row[$column] . '</td>';
			}
			echo '<td><button type="button" onclick="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#delModal">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
  <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
  <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
</svg>
</button></td>';
			echo '</tr>';
		}
		?>
		</tbody>
	</table>
</div>
<?php
$contenu = ob_get_clean();
include "template.php";