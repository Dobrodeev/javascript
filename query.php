<?php
$id_el = addslashes(trim($_REQUEST['id_el']));
$mas_ar = array();
$query1 = 'SELECT r.id, o.name, r.price, r.count, op.fio FROM offers o, operators op JOIN requests r WHERE o.id=r.offer_id && op.id=r.operator_id && r.count > 2 && (r.operator_id=10 OR r.operator_id=12)';
$query2 = 'SELECT o.name, r.count, r.price FROM offers o, operators op JOIN requests r WHERE o.id=r.offer_id && op.id=r.operator_id GROUP BY r.price';
if($id_el=='id1'){
//	.....
/*	while($row=$stmt->fetch()){ */?><!--
		<div><?php /*echo $row['email'];*/?> - <?php /*echo $row['tovar'];*/?></div>
	--><?php /*}
}else if($id_el=='id2'){
*/
	echo 'Запрос 1';
}

?>