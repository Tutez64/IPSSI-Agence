<?php
echo '<form action="" method="POST">';
foreach ($column_names as $column) {
	echo '<div class="form-group">
		<label for="'.$column.'">'.$column.'</label>'.
		'<input type="text" id="'.$column.'" name="'.$column.'" class="form-control">'.
	'</div>';
}?>
	<button type="submit" name="add_entry" class="btn btn-secondary">Confirmer l'ajout</button>
<?php