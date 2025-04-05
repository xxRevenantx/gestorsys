<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Horario General de Clases de {{ $level->level }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

   <style>
        @page { margin:10px 15px 0px 15px; }

        @font-face {
        font-family: 'Nunito';
        src: url({{ storage_path("fonts/Nunito-VariableFont_wght.ttf") }}) format("truetype");
        font-weight: 700;
        font-style: normal;

        }


        body {
            font-family: "Nunito", sans-serif;
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

h1{
    margin-top: 20px;
    margin-bottom: 10px;
    font-size: 18px;
    text-align: center;
}

    </style>

</head>
<body>

    <h1>HORARIO GENERAL DE CLASES DE {{strtoupper($level->level)}}</h1>

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
    @php
    $materiasMap = [];
    $teacherInfo = [];

    // 1. Mapear id de materia con su teacher_id, nombre de materia, grado y nombre completo del profesor
    foreach ($materias as $materia) {
        $materiasMap[$materia->id] = [
            'teacher_id' => $materia->teacher_id,
            'materia' => $materia->materia,
            'grado' => $materia->grade->grado ?? 'Sin grado',
            'profesor' => ($materia->teacher->personnel->nombre ?? 'Desconocido') . ' ' .
                          ($materia->teacher->personnel->apellido_paterno ?? '') . ' ' .
                          ($materia->teacher->personnel->apellido_materno ?? '')
        ];
    }

    // 2. Inicializar estructura de profesores
    $profesores = [];

    // 3. Recorrer horarios y contar horas por materia
    foreach ($horarios as $horario) {
        foreach (['lunes', 'martes', 'miercoles', 'jueves', 'viernes'] as $dia) {
            $materiaId = $horario->$dia;

            if ($materiaId && isset($materiasMap[$materiaId])) {
                $info = $materiasMap[$materiaId];
                $teacherId = $info['teacher_id'];
                $nombreProfesor = $info['profesor'];
                $nombreMateria = $info['materia'];
                $grado = $info['grado'];

                if (!isset($profesores[$teacherId])) {
                    $profesores[$teacherId] = [
                        'nombre' => $nombreProfesor,
                        'materias' => []
                    ];
                }

                $materiaConGrado = $grado . '° ' . $nombreMateria;

                if (!isset($profesores[$teacherId]['materias'][$materiaConGrado])) {
                    $profesores[$teacherId]['materias'][$materiaConGrado] = 0;
                }

                $profesores[$teacherId]['materias'][$materiaConGrado]++;
            }
        }
    }

    // Ordenar las materias de cada profesor por grado
    foreach ($profesores as &$profesor) {
        uksort($profesor['materias'], function ($a, $b) {
            $gradoA = intval(explode('°', $a)[0]);
            $gradoB = intval(explode('°', $b)[0]);
            return $gradoA <=> $gradoB;
        });
    }

    // Calcular el total de horas
    $totalHoras = array_reduce($profesores, function ($carry, $profesor) {
        return $carry + array_sum($profesor['materias']);
    }, 0);
    @endphp

    <table>
        <thead>
            <tr>
                <th>Profesor</th>
                <th>Materias</th>
                <th>Total de Horas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($profesores as $profesor)
                <tr>
                    <td>{{ $profesor['nombre'] }}</td>

                    {{-- Materias --}}
                    <td>
                        @foreach ($profesor['materias'] as $materia => $horas)
                            {{ $materia }} ({{ $horas }} horas)<br>
                        @endforeach
                    </td>

                    <td>{{ array_sum($profesor['materias']) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" class="font-bold text-right">Total de Horas:</td>
                <td>{{ $totalHoras }}</td>
            </tr>
        </tbody>
    </table>


</body>
</html>
