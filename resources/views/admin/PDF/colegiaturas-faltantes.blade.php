<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ public_path('storage/icon.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="http://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <title>Colegiaturas pagadas y faltantes</title>

    <style>
            @page { margin:10px 30px 0px 30px; }
        body {
            font-family: 'Noto Sans', sans-serif;
            margin: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            font-size: 24px;
            color: #333;
        }

        .container {
            /* width: 80%; */
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        table {
            width: 100% ;
            border-collapse: collapse;
            margin: auto
        }

        thead th {
            background-color: #004085;
            color: #fff;
            padding: 10px;
            font-size: 14px;
            text-align: center;
        }

        tbody td {
            padding: 8px;
            text-align: center;
            font-size: 13px;
        }

        tbody td:first-child {
            width: 40px;
        }

        tbody td:nth-child(2) {
            text-align: left;
        }

        td img {
            width: 14px;
            display: block;
            margin: 0 auto;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9ecef;
        }

    </style>

</head>

<body>

    <h1>{{ $grade->grado }}° de {{ $level->level }} </h1>

    <div class="container">
        <table border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    @foreach ($months as $month )
                        <th>{{ $month->mes }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($students as $key => $student)
                    <tr>
                        <td style="width: 2px">{{ $key+1 }}</td>
                        <td style="width: 95px">
                            {{ $student->nombre }} {{ $student->apellido_paterno }} {{ $student->apellido_materno }}
                        </td>
                        @foreach ($months as $month)
                            @php
                                $pago = $student->colegiaturas->firstWhere('month_id', $month->id);
                                $icono = $pago ? 'check.png' : 'error.png';
                            @endphp
                            <td>
                                <img src="{{ public_path('storage/' . $icono) }}" alt="estado">
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
