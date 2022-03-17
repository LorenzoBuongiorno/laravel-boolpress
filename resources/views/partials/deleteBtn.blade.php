<form action="{{ route('admin.posts.destroy' , $post->id) }}" method="post">
    @csrf
    @method('delete')

    <button class="btn btn-link text-danger" type="submit">Elimina</button>
</form>