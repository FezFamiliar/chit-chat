<a class="post_action" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre title="Edit or delete this"></a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="PostAction">
		<li class="dropdown-item"><span class="edit"></span>Edit</li>
		<a href="{{ route('delete.post', ['postid' => $id]) }}" class="dropdown-item"><span class="delete"></span>Delete</a>
</div>