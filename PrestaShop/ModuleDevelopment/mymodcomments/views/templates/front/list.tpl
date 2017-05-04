<h1>{l s='Comments on product' mod='mymodcomments'}"{$product->name}"</h1>

<div class="rte">
{foreach from=$comments item=comment}
	<div class="mymodcomments-comment">
		<img src="http://www.gravatar.com/avatar/{$comment.email|trim|strtolower|md5}?s=45" class="pull-left img-thumbnail mymodcomments-avatar" />
		<div>{$comment.firstname} {$comment.lastname|substr:0:1}. <small>{$comment.date_add|substr:0:10}</small></div>
		<div class="star-rating"><i class="glyphicon glyphicon-star"></i> <strong>{l s='Grade:' mod='mymodcomments'}</strong></div> <input value="{$comment.grade}" type="number" class="rating" min="0" max="5" step="1" data-size="xs" />
		<div><i class="glyphicon glyphicon-comment"></i> <strong>{l s='Comment' mod='mymodcomments'} #{$comment.id_mymod_comment}:</strong> {$comment.comment}</div>
	</div>
	<hr />
{/foreach}
</div>

<ul class="pagination">
	
</ul>