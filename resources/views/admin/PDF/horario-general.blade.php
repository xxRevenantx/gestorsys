<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Horario General de Clases</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400..800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;

        }

        table {
            /* border-collapse: collapse; */
            width: 100%;
            margin: 20px 0;
            font-size: 13px;
        }

        th, td {
            padding: 3px;
            text-align: center;
            /* border: 1px solid #ddd; */
            border-radius: 5px;
        }

        th {
            background-color: #f4b400;
            color: white;
            padding: 12px;
            font-size: 20px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .bg-blue-100 {
            background-color: #ebf8ff;
        }

        .border-gray-300 {
            border-color: #d1d5db;

        }

        .border-red-500 {
            background: #f56565
        }

        .border-pink-500 {
            background: #ed64a6
        }

        .border-purple-500 {
            background: #9f7aea
        }

        .border-blue-500 {
            background: #4299e1
        }

        .border-green-500 {
            background: #48bb78
        }

        .bg-yellow-400 {
            background-color: #f6e05e;
            color: white;
        }

        .page-break {
page-break-before: always;
}
    </style>

</head>
<body>

    @php
    // Agrupar por hora y ordenar por hora desc y grade_id
    $horasAgrupadas = collect($horarios)
    ->sortBy(function($item) {
        $horaInicio = explode('-', $item['hora'])[0]; // "07:00am"
        return \Carbon\Carbon::createFromFormat('h:ia', $horaInicio);
    })
    ->sortBy('grade_id')
    ->groupBy('hora');
    @endphp

<table class="table-auto w-full border border-gray-300 text-sm text-center">
    <thead>
        <tr class="bg-yellow-400 text-white">
            <th class="border border-gray-300 px-2 py-2">Hora</th>
            <th class="border border-red-500 px-2 py-2">Lunes</th>
            <th class="border border-pink-500 px-2 py-2">Martes</th>
            <th class="border border-purple-500 px-2 py-2">Miércoles</th>
            <th class="border border-blue-500 px-2 py-2">Jueves</th>
            <th class="border border-green-500 px-2 py-2">Viernes</th>
        </tr>
    </thead>
    <tbody>

        @foreach($horasAgrupadas as $hora => $bloqueHorarios)
            <tr class="bg-blue-100">
            <td class="border border-gray-300 px-2 py-1">
                {{ $hora }}
            </td>
            @foreach(['lunes', 'martes', 'miercoles', 'jueves', 'viernes'] as $dia)
                @php
                $materiasDia = $bloqueHorarios->pluck($dia)->unique()->map(function($id) use ($materias) {
                    $materia = $materias->firstWhere('id', $id);
                    return $materia ? $materia->grade->grado . '° ' . $materia->materia : '-';
                })->filter()->join('<br>');
                @endphp
                <td class="border border-gray-300 px-2 py-1">
                {!! $materiasDia ?: '-' !!}
                </td>
            @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

<div class="page-break"></div>



</body>
</html>
