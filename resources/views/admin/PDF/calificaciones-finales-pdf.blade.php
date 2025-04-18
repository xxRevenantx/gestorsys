<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calificaciones finales {{ $student->nombre }} {{ $student->apellido_paterno }} {{ $student->apellido_materno }} | {{ $student->CURP }}</title>
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

        .container {
            margin: 0 auto;
            position: relative;
            min-height: 100vh; /* Asegura que el contenedor ocupe al menos toda la altura de la página */
            background-image: url('{{ public_path('storage/icon.png') }}');
            background-size: cover;
            background-position: center;


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
        thead th:nth-child(2) { background-color: #27ae60;   border-radius: 5px;   } /* PERIODO */
        thead th:nth-child(3) { background-color: #27ae60;   border-radius: 5px;   } /* PERIODO */
        thead th:nth-child(4) { background-color: #27ae60;   border-radius: 5px;   } /* PERIODO */

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

    <div class="titulo">Calificaciones finales </div>


    <div class="subtitulo">Nombre del Estudiante: {{ $student->nombre }} {{ $student->apellido_paterno }} {{ $student->apellido_materno }} </div>
    <div class="subtitulo">Grado: {{ $student->grade->grado }}° grado</div>
    <div class="subtitulo">Fecha: {{ date('d/m/Y') }}</div>



    <table>
        <thead>
            <tr>
                <th style="background-color: #4caf50; color: white;">CAMPOS FORMATIVOS</th>
                @foreach ($periodos as $periodo)
                    <th style="background-color: #2e7d32; color: white;">{{ $periodo->num_periodo }}° PERIODO</th>
                @endforeach
                <th style="background-color: #1976d2; color: white;">Promedio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($calificacionesPorMateria as $materia => $datos)
                <tr>
                    <td style="background-color: #e8f5e9;">{{ $materia }}</td>
                    @foreach ($periodos as $periodo)
                        <td style="text-align: center;">
                            {{ $datos['periodos'][$periodo->num_periodo] ?? '' }}
                        </td>
                    @endforeach
                    <td style="font-weight: bold; text-align: center;">
                        {{ $datos['promedio'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="background-color: #f5f5f5; font-weight: bold;">Promedio por periodo:</td>
                @foreach ($periodos as $periodo)
                    <td style="text-align: center; background-color: #f5f5f5;">
                        {{ $promedioPorPeriodo[$periodo->num_periodo] ?? '-' }}
                    </td>
                @endforeach
                <td style="background-color: #f5f5f5;"></td>
            </tr>
            <tr>
                <td colspan="{{ count($periodos) + 1 }}" style="text-align: right; font-weight: bold; padding-top: 10px;">
                    Promedio general del alumno:
                </td>
                <td style="text-align: center; font-size: 16px; font-weight: bold; color: #2e7d32;">
                    {{ $promedioGeneralAlumno }}
                </td>
            </tr>
        </tfoot>

    </table>

    <br><br>
    <h3 style="margin-bottom: 10px; font-size: 16px; font-weight: bold;">Materias No Calificables</h3>

    <table>
        <thead>
            <tr>
                <th style="background-color: #90caf9; color: white;">MATERIAS EXTRAS</th>
                @foreach ($periodos as $periodo)
                    <th style="background-color: #42a5f5; color: white;">{{ $periodo->num_periodo }}° PERIODO</th>
                @endforeach
                <th style="background-color: #1976d2; color: white;">Promedio</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($noCalificables as $materia => $datos)
                <tr>
                    <td style="background-color: #e3f2fd;">{{ $materia }}</td>
                    @foreach ($periodos as $periodo)
                        <td style="text-align: center;">
                            {{ $datos['periodos'][$periodo->num_periodo] ?? '' }}
                        </td>
                    @endforeach
                    <td style="font-weight: bold; text-align: center;">
                        {{ $datos['promedio'] }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($periodos) + 2 }}" style="text-align: center;">
                        No hay materias no calificables registradas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>







    <div class="subtitulo" style="margin-top: 20px; font-size: 14px; text-align: justify; color: #555;">
        Nota: Para el promedio final de grado sólo se toma en cuenta la sumatoria de los promedios de los campos formativos.

    </div>


</div>

<footer>
    © 2025
</footer>
</body>
</html>
