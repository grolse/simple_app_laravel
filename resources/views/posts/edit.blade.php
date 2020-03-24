<form action="{{ route('posts.update', ['post' => $post->id]) }}" method="post">
    @csrf
    @method('patch')
    <input type="text" name="title" value="{{ $post->title }}"/>
    <textarea name="content">{{ $post->content }}</textarea>
    <button type="submit">Update post</button>
</form>
