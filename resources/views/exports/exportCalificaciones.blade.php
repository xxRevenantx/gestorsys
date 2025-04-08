<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>
<table>
    <thead>
        <tr>
            <th>Nombre Completo</th>
            <th>Calificacion</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($calificaciones as $calificacion)
            <tr>
                <td>{{ $calificacion->student->nombre }} {{ $calificacion->student->apellido_paterno }} {{ $calificacion->student->apellido_materno }}  </td>
                <td>{{ $calificacion->calificacion }}</td>
            </tr>
           @endforeach
    </tbody>
</table>
