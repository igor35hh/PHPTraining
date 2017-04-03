<h1>List os articles by category</h1>
<?php if($articles): ?>
<?php foreach ($articles as $value): ?>
	<h2><? = $value['title']; ?></h2>
	<p><? = $value['small_text']; ?></p>
	<a href="/article/?id=<? = $value['id']; ?>">Read more</a>
<?php endforeach; ?>
<?php else: ?>
	<h2>This category doesn't have articles</h2>
<?php endif; ?>