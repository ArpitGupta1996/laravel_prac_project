<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>

    <h1>Users Details Are as Follows</h1>


    <div class="row">
        <div class="col">
            <input type="text" name="name" value="{{$user_detail['0']['name']}}" class="form-control" placeholder="First name" aria-label="First name">
        </div>
        <div class="col">
            <input type="number" name="phone" value="{{$user_detail['0']['phone']}}" class="form-control" placeholder="phone number" aria-label="phone number">
        </div>

        <div class="col">
            <input type="text" name="gender"  value="{{$user_detail['0']['gender']}}" class="form-control" placeholder="gender" aria-label="gender">
        </div>

        <div class="col">
            <input type="text" name="martial_status" value="{{$user_detail['0']['martial_status']}}" class="form-control" placeholder="martial_status" aria-label="martial_status">
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
