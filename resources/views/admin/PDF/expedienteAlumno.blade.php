<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <title>Cédula de Inscripción</title>
</head>
<style>
    body {
    width: 21.59cm;
    height: 27.94cm;
    padding: 20px;
    font-family: 'figtree', sans-serif;
    margin: auto;
}

.container {

    margin: 0 auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #4CAF50;
    color: white;
    padding: 10px;
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
    border: 1px solid #ccc;
    padding: 8px;
    text-align: left;
}

th {
    background: #9AB94E;
    font-weight: bold;
}

p.nota {
    font-size: 14px;
    color: red;
}

footer {
    text-align: center;
    font-size: 14px;
    margin-top: 20px;
    padding: 10px;
    background: #ddd;
    border-radius: 0 0 8px 8px;
}

</style>
<body>



    <div class="container">
        <header>
            <h1>CÉDULA DE INSCRIPCIÓN</h1>
            <span class="fecha">Fecha: 03/03/2025</span>
        </header>

        <h2>DATOS GENERALES</h2>
        <table>
            <tr>
                <th colspan="1">NOMBRE DEL ALUMNO (A)</th>
                <td>{{$student->nombre}}</td>
                <td>{{$student->apellido_paterno}}</td>
                <td>{{$student->apellido_materno}}</td>
            </tr>
            <tr>
                <th>Edad</th>
                <td>5 años</td>
                <th>Fecha de Nacimiento</th>
                <td>2018-10-28</td>
                <th>Sexo</th>
                <td>Masculino</td>
            </tr>
            <tr>
                <th>CURP</th>
                <td colspan="5">GAPL181028HGRRRSA4</td>
            </tr>
            <tr>
                <th>Lugar de Nacimiento</th>
                <td colspan="5">0</td>
            </tr>
            <tr>
                <th>Domicilio de Procedencia</th>
                <td colspan="5"></td>
            </tr>
            <tr>
                <th>Teléfono</th>
                <td colspan="2">111-1111</td>
                <th>Email</th>
                <td colspan="2"></td>
            </tr>
            <tr>
                <th>Nombre del Padre o Tutor</th>
                <td colspan="5">Esmeralda Pérez Medina</td>
            </tr>
        </table>

        <h2>DATOS ESCOLARES</h2>
        <table>
            <tr>
                <th>Nivel</th>
                <td>Primaria</td>
                <th>Grado</th>
                <td>1°</td>
                <th>Grupo</th>
                <td>A</td>
            </tr>
            <tr>
                <th>Generación</th>
                <td>12</td>
                <th>Turno</th>
                <td colspan="3">Matutino</td>
            </tr>
        </table>

        <h2>REGISTRO DE DOCUMENTACIÓN</h2>
        <table>
            <tr>
                <th>Certificado</th>
                <td></td>
            </tr>
            <tr>
                <th>Acta de Nacimiento</th>
                <td></td>
            </tr>
            <tr>
                <th>Certificado Médico</th>
                <td></td>
            </tr>
            <tr>
                <th>6 Fotografías Tamaño Infantil B/N</th>
                <td></td>
            </tr>
            <tr>
                <th>CURP</th>
                <td></td>
            </tr>
        </table>

        <p class="nota">
            * La documentación mencionada deberá entregarse al momento de inscribirse. <br>
            * El alumno podrá inscribirse careciendo del certificado correspondiente siempre y cuando presente constancia de acreditación y lo presente en el plazo que se indique.
        </p>

        <footer>
            <p>Beca: <strong>$0.00</strong></p>
            <p>CD. Altamirano, GRO., a 03 de marzo de 2025</p>
        </footer>
    </div>

</body>
</html>
