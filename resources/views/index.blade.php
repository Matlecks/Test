<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500&display=swap"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800&display=swap"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title></title>
</head>
@php
    use App\Models\Like;
    use App\Models\Post;
    use App\Models\Tags;
@endphp

<body>
    <div class="container">
        @foreach ($posts as $post)
            <div class=" border border-secondary rounded-3 p-4">
                <div class="d-flex justify-content-between">
                    <div class="col-8">
                        <div class="d-flex">
                            <div class="fw-bold h4">{{ $post->title }}</div>
                            <div class="fw-bold h4 ms-3" style="color: #f0f0f0">
                                {{ $post->created_at }}
                            </div>
                        </div>
                        <div class="text-start">{{ $post->text }}</div>
                    </div>
                    <div class="col-4" style="height: 100%;"><img
                            src="/storage/{{ $post->img }}"
                            style="width: 30%; height: 30%; object-fit: cover; border-top-left-radius: 4px; border-bottom-left-radius: 4px;">
                    </div>
                </div>
                <div class="d-flex justify-content-between col-12">
                    <div class="col-6">
                       {{--  @php
                            $tags = Post::find($post->id)->tags;
                        @endphp --}}
                        @php
                        $post = Post::find($post->id);
                        $tags = $post->tags;
                        $tagNames = $post->tags()->pluck('title');
                        foreach ($tagNames as $tagName) {
                            echo $tagName . ',';
                        }
                        @endphp
                    </div>
                    <div class="col-6">

                        <form action="{{ route('likes.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <button type="submit">Нравится</button>
                        </form>
                        {{-- @php
                            $like = Like::find($post->id);
                        @endphp --}}
                        <form action="{{ route('likes.destroy', $like = $post->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')

                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <button type="submit">Не нравится</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
</body>

</html>
