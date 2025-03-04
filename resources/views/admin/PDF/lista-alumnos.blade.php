<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <title>Lista de Alumnos</title>
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


.fecha {
    font-size: 16px;
    font-weight: bold;
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
    text-align: center
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
.titulo{
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    margin: 10px 0;
}
p{
    text-align: center;
    font-size: 16px;
    font-weight: bold;
}

</style>
<body>

    <div class="container">

        <h2 class="titulo">ESCUELA</h2>
        <p>LISTA DE EVALUACIÓN</p>

        <table>
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>CURP</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Grado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->matricula }}</td>
                        <td>{{ $student->CURP }}</td>
                        <td>{{ $student->nombre }} {{ $student->apellido_paterno }} {{ $student->apellido_materno  }} </td>
                        <td>{{ $student->edad }}</td>
                        <td>{{ $student->grado }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>

    <footer>
        <p>Centro Universitario Moctezuma"</p>
        <p>Av. 16 de Septiembre No. 1, Col. Centro, C.P. 40880, Zihuatanejo, Guerrero.</p>
        <p>Tel. 755 554 00 00</p>
    </footer>

</body>
</html>
