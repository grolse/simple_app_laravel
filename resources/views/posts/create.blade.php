<form action="{{ route('posts.store') }}" method="post">
    @csrf
    <input type="text" name="title"/>
    <textarea name="content"></textarea>
    <button type="submit">Create post</button>
</form>
