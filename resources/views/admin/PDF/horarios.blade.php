<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Horario de Clases</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400..800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <style>
  @page { margin:10px 30px 0px 30px; }
        body{
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            font-family: 'Segoe UI', sans-serif;
            text-align: center;
            margin-top: 30px;


            border-collapse: separate; /* Necesario para que funcione border-spacing */
            border-spacing: 5px 5px; /* 5px entre columnas, 5px entre filas */
            width: 100%;
        }

        thead th {
            padding: 12px;
            font-weight: bold;
            color: white;
            font-size: 14px;
        }

        /* Colores de encabezado */
        thead th:nth-child(1) { background-color: #f39c12;   border-radius: 5px;   } /* Hora */
        thead th:nth-child(2) { background-color: #e74c3c;   border-radius: 5px;   } /* Lunes */
        thead th:nth-child(3) { background-color: #9b59b6;   border-radius: 5px;   } /* Martes */
        thead th:nth-child(4) { background-color: #2980b9;   border-radius: 5px;   } /* Miércoles */
        thead th:nth-child(5) { background-color: #3498db;   border-radius: 5px;   } /* Jueves */
        thead th:nth-child(6) { background-color: #27ae60;   border-radius: 5px;   } /* Viernes */

        tbody td {
            padding: 10px;
            font-size: 12px;
            border-radius: 5px;
            background-color: #d6eaf8;
            border-spacing: 10px

        }

        /* Primera columna: Horas */
        tbody td:first-child {
            background-color: #d5f5e3;
            font-weight: bold;
            color: #2c3e50;
        }

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 15px 0;
            font-size: 14px;
            color: #555;
        }


        .titulo {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
            color: #333;
        }
        .subtitulo {
            font-size: 18px;
            text-align: center;
            margin-top: 5px;
            color: #666;
        }

    </style>
</head>
<body>


<div class="container">
    <div class="decoraciones">
        <!-- Arcoíris SVG -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"><path fill="#f9dd62" d="M32 4A28 28 0 0 1 60 32h-4A24 24 0 0 0 32 8Z"/><path fill="#f582ae" d="M32 10a22 22 0 0 1 22 22h-4a18 18 0 0 0-18-18Z"/><path fill="#a9def9" d="M32 16a16 16 0 0 1 16 16h-4a12 12 0 0 0-12-12Z"/></svg>
    </div>

    <div class="titulo">Horario de Clases</div>
    <div class="subtitulo"> {{ $grade->grado }}° de {{ $level->level }}</div>

    <table class="table table-bordered" >
        <thead>
        <tr>
            <th>Hora</th>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miércoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
        </tr>
        </thead>
        <tbody>
        @foreach($horarios as $horario)
            <tr>
            <td>{{ $horario->hora }}</td>
            <td>
                @if($horario->hora === '09:00am-09:30am')
                RECESO
                @else
                {{ $horario->lunesMateria->materia ?? '-' }}
                @endif
            </td>
            <td>
                @if($horario->hora === '09:00am-09:30am')
                RECESO
                @else
                {{ $horario->martesMateria->materia ?? '-' }}
                @endif
            </td>
            <td>
                @if($horario->hora === '09:00am-09:30am')
                RECESO
                @else
                {{ $horario->miercolesMateria->materia ?? '-' }}
                @endif
            </td>
            <td>
                @if($horario->hora === '09:00am-09:30am')
                RECESO
                @else
                {{ $horario->juevesMateria->materia ?? '-' }}
                @endif
            </td>
            <td>
                @if($horario->hora === '09:00am-09:30am')
                RECESO
                @else
                {{ $horario->viernesMateria->materia ?? '-' }}
                @endif
            </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <table>
        <thead>
        <tr>
            <th>PROFESOR</th>
            <th>MATERIA</th>
        </tr>
        </thead>
        <tbody>



        <tbody>
            @foreach($materiasAgrupadas as $profesor => $materias)
                <tr>
                    <td>{{ $profesor }}</td>
                    <td style="text-align: left; text-transform:uppercase">
                        @foreach($materias as $materia)
                            {{ $materia->materia }}<br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
        </tbody>
    </table>

</div>

<footer>
    © 2025 - Centro Educativo Infantil y Juvenil
</footer>
</body>
</html>
