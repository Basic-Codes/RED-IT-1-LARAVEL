<x-admin-master>
    @section('content')
        <h1>Create</h1>
        
        <script src="https://cdn.tiny.cloud/1/6mc0j94qnszxq0i3fb2s0e5u92m8naaiwchfi5m9osfu3kdn/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

        <div class="card rounded" style="background: #a8a8a8">
            <div class="card-header text-light" style="background: #5c80ec">
                @if ($errors->any())
                <div class="alert alert-danger mb-0">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @else
                    New Post
                @endif
            </div>

            <div class="card-body">
                <form action="{{route('post.create')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input name="title" type="text" class="form-control my-3" id="" aria-describedby="emailHelp" placeholder="Title">
                    <div class="custom-file mb-3">
                        <input name="post_image" type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <textarea name="content" id="mytextarea" rows="12"></textarea>
                    <a href="{{route('home')}}" class="btn btn-light btn-lg float-right my-3">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-lg float-right mr-2 mt-3 mb-3">Post</button>
                </form>
            </div>
        </div>


        <script>
            tinymce.init({
                selector: '#mytextarea',
                // plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
                // toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
                // toolbar_mode: 'floating',
                // tinycomments_mode: 'embedded',
                // tinycomments_author: 'Author name',
                images_upload_url: 'postAcceptor.php',
                automatic_uploads: true,
                images_upload_url: 'postAcceptor.php',
                images_reuse_filename: true,
                file_picker_types: 'file image media'
            });
        </script>

    @endsection
</x-admin-master>
