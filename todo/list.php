<a href="?id=0">Add item</a>
<? foreach ($LIST as $row): ?>
<li> <a href="?id=<?=$row['id']?>"><?=$row['name']?></a>
<? endforeach ?>