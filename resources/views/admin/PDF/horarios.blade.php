<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <title>Horario de clases</title>
</head>
<style>
    body {
    /* width: 21.59cm;
    height: 27.94cm; */
    /* padding: 20px; */
    font-family: 'figtree', sans-serif;
    margin: auto;
    font-size: 13px;
}

table td{
    text-align: center;
}

</style>

<body>

    <div class="container">

        <div class="fecha" style="text-align: center; margin-top: 20px; font-size: 16px; font-weight: bold;">Horario de Clases</div>

        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;" border="1">
            <thead>
                <tr>
                    <th style="padding: 8px; text-align: left;">Hora</th>
                    <th style="padding: 8px; text-align: left;">Lunes</th>
                    <th style="padding: 8px; text-align: left;">Martes</th>
                    <th style="padding: 8px; text-align: left;">Miércoles</th>
                    <th style="padding: 8px; text-align: left;">Jueves</th>
                    <th style="padding: 8px; text-align: left;">Viernes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($horarios as $horario)
                <tr>
                    <td style="padding: 8px;">{{ $horario->hora }}</td>
                    <td style="padding: 8px;">{{ $horario->lunesMateria->materia ?? '-' }}</td>
                    <td style="padding: 8px;">{{ $horario->martesMateria->materia ?? '-' }}</td>
                    <td style="padding: 8px;">{{ $horario->miercolesMateria->materia ?? '-' }}</td>
                    <td style="padding: 8px;">{{ $horario->juevesMateria->materia ?? '-' }}</td>
                    <td style="padding: 8px;">{{ $horario->viernesMateria->materia ?? '-' }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;" border="1">
            <thead>
                <tr>
                    <th style="padding: 8px; text-align: left;">Materia</th>
                    <th style="padding: 8px; text-align: left;">Profesor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materias as $materia)
                <tr>
                    <td style="padding: 8px;">{{ $materia->materia }}</td>
                    <td style="padding: 8px;">
                        {{ ucfirst(strtolower($materia->teacher->personnel->nombre ?? '-')) }} 
                        {{ ucfirst(strtolower($materia->teacher->personnel->apellido_paterno ?? '-')) }} 
                        {{ ucfirst(strtolower($materia->teacher->personnel->apellido_materno ?? '-')) }}
                    </td>
                      
                @endforeach
            </tbody>
        </table>
        
        
    </div>


</body>
</html>
