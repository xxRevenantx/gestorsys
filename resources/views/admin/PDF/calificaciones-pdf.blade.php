<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Boleta de calificaciones {{ $student->nombre }} {{ $student->apellido_paterno }} {{ $student->apellido_materno }} | {{ $student->CURP }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ public_path('storage/icon.png') }}" type="image/png">


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
        thead th:nth-child(1) { background-color: #2980b9;   border-radius: 5px;   } /* MNATERIA */
        thead th:nth-child(2) { background-color: #27ae60;   border-radius: 5px;   } /* CALIFICACION */

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

    <div class="titulo">Boleta de calificaciones  </div>


    <div class="subtitulo">Nombre del Estudiante: {{ $student->nombre }} {{ $student->apellido_paterno }} {{ $student->apellido_materno }} </div>
    <div class="subtitulo">Grado: {{ $student->grade->grado }}° grado</div>
    <div class="subtitulo">Periodo: {{ $periodo->num_periodo }}° Periodo</div>
    <div class="subtitulo">Fecha: {{ date('d/m/Y') }}</div>

    <table>
        <thead>
            <tr>
                <th>Materia</th>
                <th>Calificación</th>

            </tr>
        </thead>
        <tbody>
            {{-- Iteramos sobre cada calificación del alumno --}}
            @foreach($calificaciones as $calificacion)
                <tr>
                    {{-- Mostramos el nombre de la materia asociada a la calificación --}}
                    <td>{{ $calificacion->materia->materia }}</td>

                    {{-- Mostramos la calificación del alumno para esa materia --}}
                    <td>{{ $calificacion->calificacion }}</td>
                </tr>
            @endforeach

            {{--
                Calculamos el promedio, pero solo de las calificaciones que correspondan
                a materias que tienen la columna 'calificacion' en 1 dentro de la tabla 'materias'.
                Es decir, solo se promedian las calificaciones de materias marcadas como válidas (1).
            --}}
            @php
                $promedio = $calificaciones
                    // Filtramos las calificaciones cuyo objeto 'materia' tiene calificacion == 1
                    ->filter(function($calificacion) {
                        return $calificacion->materia->calificacion == 1;
                    })
                    // Calculamos el promedio solo de los valores de 'calificacion' de esas materias
                    ->avg('calificacion');
            @endphp

            {{-- Fila final donde mostramos el promedio --}}
            <tr>
                <td style="background: #d3d3d3; font-weight: bold; color: #2c3e50;">
                    <strong>Promedio</strong>
                </td>
                <td style="background: #d3d3d3; font-weight: bold; color: #2c3e50;">
                    {{-- Mostramos el promedio con 2 decimales --}}
                    {{ number_format($promedio, 2) }}
                </td>
            </tr>
        </tbody>


    </table>

    <div class="subtitulo" style="margin-top: 20px; font-size: 14px; text-align: justify; color: #555;">
        Nota: Solo los campos formativos (Lenguajes, Saberes y Pensamiento Científico, Ética, Naturaleza y Sociedades, De lo Humano y Comunitario) son calificados.
    </div>


</div>

<footer>
    © 2025
</footer>
</body>
</html>
