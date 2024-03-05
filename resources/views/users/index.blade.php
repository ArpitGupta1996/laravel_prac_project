<!DOCTYPE html>
<html>

<head>
    <title>Laravel 9 Generate PDF File Using DomPDF - Techsolutionstuff</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12" style="margin-top: 15px ">
                <div class="pull-left">
                    <h2>Download Your PDF</h2>
                    <h4><?php echo date('d-m-Y'); ?></h4>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('users.index', ['download' => 'pdf']) }}">Download PDF</a>
                </div>
            </div>
        </div><br>
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            @foreach ($user as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}">
                            <i class="fa fa-pencil" title="edit"></i> &nbsp; &nbsp;
                        </a>

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="fa fa-trash" title="delete"></i> &nbsp; &nbsp;
                            </button>
                        </form>

                        <a href="{{ route('users.show', $user->id) }}" target="blank">
                            <i class="fa fa-eye" title="view"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
