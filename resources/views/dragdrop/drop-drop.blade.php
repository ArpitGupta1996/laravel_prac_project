<!DOCTYPE html>
<html>
<head>
    <title>Laravel 11 Drag & Drop Image Upload Example - Tutsmake.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
</head>
<body>

<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mt-2 mb-2">Laravel 11 Drag & Drop Image Upload Example - Tutsmake.com</h1>

            <form action="{{ URL('uploadFiles') }}" method="post" enctype="multipart/form-data" id="image-upload" class="dropzone">
                @csrf
                <div>
                    <h3>Upload Multiple Image By Click On Box</h3>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    Dropzone.options.imageUpload = {
        maxFilesize         :       1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif"
    };
</script>
</body>
</html>
