<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <title>Expediente del alumno</title>
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

.container {
    margin: -30px auto 0;
    background: white;
    /* border-radius: 8px; */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

header {
    text-align: center;
    background: #18568c;
    color: white;
    padding: 5px;
    border-radius: 8px 8px 0 0;
}

.fecha {
    font-size: 16px;
    font-weight: bold;
}

h2 {
    background: #9AB94E;
    padding: 8px;
    text-align: center;
    border-radius: 5px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 10px 0;
}

th, td {
    border: 1px solid #8a8a8a;
    padding: 8px;
    text-align: left;
}
td{
    text-align: center;
}

th {
    background: #ccc;
    font-weight: bold;
}

p.nota {
    font-size: 14px;
    color: red;
}

footer {
    text-align: center;
    font-size: 12px;
    padding: 5px;
    background: #ddd;
    border-radius: 0 0 8px 8px;
}
.sm{
    font-size: 8px;
}

</style>
<body>

    <div class="container">
        <header>
            <h1>EXPEDIENTE DEL ALUMNO</h1>
        </header>


        <h2>DATOS ESCOLARES</h2>
        <table>
            <tr>
                <th colspan="1">Nombre del alumno(a)</th>
                <td>{{$student->nombre}}</td>
                <td>{{$student->apellido_paterno}}</td>
                <td colspan="3">{{$student->apellido_materno}}</td>
                <td rowspan="3"  style="width: 100px">
                    @if ($student->imagen)
                    <img src="{{ public_path('storage/students/'.$student->imagen) }}" alt="{{ $student->nombre }}" height="100px" width="100">

                    @else
                    <img src="#" alt="{{ $student->nombre }}" alt="{{ $student->nombre }}" height="100px" width="100">

                    @endif


                </td>

            </tr>
            <tr>
                <th style="background: #fff; border:none" colspan="1"></th>
                <td class="sm">APELLIDO PATERNO</td>
                <td class="sm">APELLIDO MATERNO</td>
                <td colspan="3" class="sm">NOMBRE(S)</td>

            </tr>
            <tr>
                <th>Edad</th>
                <td>{{ $student->edad }}</td>
                <th>Fecha de Nacimiento</th>
                <td>{{ \Carbon\Carbon::parse($student->fecha_nacimiento)->format('d/m/Y') }}</td>
                <th>Género</th>
                <td>{{ $student->genero }}</td>

            </tr>
            <tr>
                <th>Nivel</th>
                <td>{{ $student->level->level }}</td>
                <th>Grado</th>
                <td>{{ $student->grade->grado }}° grado</td>
                <th>Grupo</th>
                <td colspan="2">"{{ $student->group->grupo }}"</td>
            </tr>
            <tr>
                <th>Generación</th>
                <td colspan="6">{{ $student->generation->anio_inicio }} - {{ $student->generation->anio_termino }} </td>
            </tr>

        </table>

        <h2>DATOS DE DOMICILIO</h2>
        <table>
            <tr>
                <th>País de Nacimiento</th>
                <td>{{ $student->pais_nacimiento }}</td>
                <th>Estado de Nacimiento</th>
                <td colspan="3">{{ $student->estado_nacimiento }}</td>
            </tr>
            <tr>
                <th>Municipio Nacimiento</th>
                <td>{{ $student->municipio_nacimiento }}</td>
                <th>Estado donde vive</th>
                <td  colspan="3">{{ $student->estado_vive }}</td>
            </tr>
            <tr>
                <th>Municipio donde vive</th>
                <td>{{ $student->municipio_vive }}</td>
                <th>Colonia</th>
                <td  colspan="3">{{ $student->colonia }}</td>
            </tr>
            <tr>
                <th>Calle</th>
                <td>{{ $student->calle }}</td>
                <th>Número</th>
                <td>{{ $student->numero }}</td>
                <th>C.P.</th>
                <td>{{ $student->CP }}</td>
            </tr>
        </table>

        <h2>DATOS DEL TUTOR</h2>
        <table>
            <tr>
                <th>Nombre del tutor</th>
                <td colspan="5">{{ $student->tutor->nombre }} {{ $student->tutor->apellido_paterno }} {{ $student->tutor->apellido_materno }} </td>
            </tr>
            <tr>
                   <th>Dirección</th>
                    <td>{{ $student->tutor->calle }}</td>
                   <th>No. ext.</th>
                    <td>{{ $student->tutor->num_ext }}</td>
                   <th>No. int.</th>
                    <td>{{ $student->tutor->num_int }}</td>
            </tr>
            <tr>
                   <th>Localidad</th>
                    <td>{{ $student->tutor->localidad }}</td>
                   <th>Colonia</th>
                    <td colspan="3">{{ $student->tutor->colonia }}</td>
            </tr>
            <tr>
                   <th>Municipio</th>
                    <td>{{ $student->tutor->municipio }}</td>
                   <th>Estado</th>
                    <td colspan="3">{{ $student->tutor->estado }}</td>
            </tr>
            <tr>
                   <th>Teléfono</th>
                    <td>{{ $student->tutor->telefono }}</td>
                   <th>Celular</th>
                    <td colspan="3">{{ $student->tutor->celular }}</td>
            </tr>
            <tr>
                   <th>Email</th>
                    <td>{{ $student->tutor->email }}</td>
                   <th>Parentesco</th>
                    <td colspan="3">{{ $student->tutor->parentesco }}</td>
            </tr>
            <tr>
                   <th>Ocupación</th>
                    <td colspan="5">{{ $student->tutor->ocupacion }}</td>
            </tr>
        </table>

    </div>

    <footer>
        <p>Centro Universitario Moctezuma"</p>
        <p>Av. 16 de Septiembre No. 1, Col. Centro, C.P. 40880, Zihuatanejo, Guerrero.</p>
        <p>Tel. 755 554 00 00</p>
    </footer>

</body>
</html>
