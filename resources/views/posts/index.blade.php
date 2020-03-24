<ul>
    @foreach($posts as $post)
        <li>
            <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
            <a href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit</a>
            <form method="post" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                @method('delete')
                @csrf
                <button type="submit">X</button>
            </form>
        </li>
    @endforeach
    <a href="{{ route('posts.create') }}">Create new post</a>
</ul>
