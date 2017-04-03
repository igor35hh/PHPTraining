<?php if($article): ?>
	<h1><? =$article['title']; ?></h1>
	<p><? =$article['text']; ?></p>
<?php else: ?>
	<h2>The article not found</h2>
<?php endif; ?>