<!DOCTYPE html>
<html>
<head>
    <title>Levels PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>


    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Logo</th>
            <th>Director</th>
            <th>Supervisor</th>
        </tr>

        @foreach ($levels as $level)
        <tr>
            <td>{{ $level->id }}</td>
            <td>{{ $level->level }}</td>
            <td>
                <img src="{{asset('storage/levels/' . $level->imagen)}}" alt="">
            </td>
            <td>{{$level->director->nombre}}</td>
            <td>{{$level->supervisor->nombre}}</td>
        </tr>
        @endforeach


    </table>

</body>
</html>
