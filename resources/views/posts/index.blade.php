<h1>This is posts page</h1>

<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Title" />
    <input type="text" name="body" placeholder="Body" />
    <input type="submit" value="Submit" />
</form>

<hr / >

<form action="/" method="GET">
    <input type="text" name="search" placeholder="Search" value="{{$search}}" />
    <input type="submit" value="Search" />
</form>

@foreach ($posts as $post)
    <p>{{ $post->title }}</p>
@endforeach

<a href="/instances">describe db instances on aws</a>

@if($output != null)
    <p>{{$output}}</p>
@endif