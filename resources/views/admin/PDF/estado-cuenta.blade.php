<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="http://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <title>Estado de cuenta</title>


<style>
        body {
        margin: auto;
        font-size: 12px;
        font-family: 'figtree', sans-serif;
    }

    .container {
        margin: -30px auto 0;
        background: white;
        /* border-radius: 8px; */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

        @font-face {
        font-family: SourceSansPro;
        src: url(SourceSansPro-Regular.ttf);
        }

        .clearfix:after {
        content: "";
        display: table;
        clear: both;
        }

        a {
        color: #0087C3;
        text-decoration: none;
        }

        header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #AAAAAA;
        }

        #logo {
        float: left;
        margin-top: 8px;
        }

        #logo img {
        height: 70px;
        }

        #company {
        float: right;
        text-align: right;
        }


        #details {
        margin-bottom: 50px;
        }

        #client {
        padding-left: 6px;
        border-left: 6px solid #0087C3;
        float: left;
        }

        #client .to {
        color: #777777;
        }

        h2.name {
        font-size: 1.4em;
        font-weight: normal;
        margin: 0;
        }

        #invoice {
        float: right;
        text-align: right;
        }
        h1{
        color: #0087C3;
        text-align: center;
        font-size: 2.6em;
        line-height: 1em;
        font-weight: normal;
        margin: 0  0 10px 0;
        }
        #invoice h1 {
        color: #0087C3;
        font-size: 2em;
        line-height: 1em;
        font-weight: normal;
        margin: 0  0 10px 0;
        }

        #invoice .date {
        font-size: 1.1em;
        color: #777777;
        }

        table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
        }

        table th,
        table td {
        padding: 10px;
        background: #EEEEEE;
        text-align: center;
        border: 1px solid #FFFFFF;
        }

        table th {
        white-space: nowrap;
        font-weight: normal;
        text-align: center
        }



        table td h3{
        color: #57B223;
        font-size: 1.2em;
        font-weight: normal;
        margin: 0 0 0.2em 0;
        }

        table .no {
        color: #FFFFFF;
        font-size: 1em;
        background: #57B223;
        }



        table .unit {
        background: #DDDDDD;
        }

        table .qty {
        }

        table .total {
        background: #57B223;
        color: #FFFFFF;
        }

        table td.unit,
        table td.qty,
        table td.total {
        font-size: 1.2em;
        }

        table tbody tr:last-child td {
        border: none;
        }

        table tfoot td {
            margin-top: 10px;
        padding: 10px 20px;
        background: #FFFFFF;
        border-bottom: none;
        font-size: 1.2em;
        white-space: nowrap;
        border-top: 1px solid #AAAAAA;
        }

        table tfoot tr:first-child td {
        border-top: none;
        }

        table tfoot tr:last-child td {
        color: #57B223;
        font-size: 1.4em;
        border-top: 1px solid #57B223;

        }

        table tfoot tr td:first-child {
        border: none;
        }

        #thanks{
        font-size: 2em;
        margin-bottom: 50px;
        }

        #notices{
        padding-left: 6px;
        border-left: 6px solid #0087C3;
        }

        #notices .notice {
        font-size: 1.2em;
        }

        footer {
        color: #777777;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #AAAAAA;
        padding: 8px 0;
        text-align: center;
        }

        .nombre
        {
            font-size: 1.2em;
        }

</style>


</head>

<body>
    <div class="container">
    <header class="clearfix">
      <div id="logo">
        <img src="logo.png">
      </div>
      <div id="company">
        <h2 class="name">Company Name</h2>
        <div>455 Foggy Heights, AZ 85004, US</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          {{-- <div class="to">Recibimos de:</div>
          <h2 class="name">{{$colegiatura->nombre_pago}}</h2>
          <div class="to">Tipo de pago:</div>
          <h2 class="name">{{$colegiatura->tipo_pago}}</h2> --}}
        </div>
        <h1>ESTADO DE CUENTA</h1>
        <div id="invoice">

          <div class="date">Fecha de expedición: {{ \Carbon\Carbon::now()->format('d/m/Y h:i') }}  </div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc" colspan="1">FECHA DE PAGO</th>
            <th class="desc" colspan="1">MES DE PAGO</th>
            <th class="desc" colspan="1">RECIBIMOS DE</th>
            <th class="desc" colspan="1">$ MONTO</th>
            <th class="desc" colspan="1">$ DESCUENTO</th>
            <th class="desc" colspan="1">$ TOTAL</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($colegiaturas as $key =>  $colegiatura)
            <tr>
                <td class="no">{{ $key+1 }}</td>
                <td class="unit">{{ \Carbon\Carbon::parse($colegiatura->fecha_pago)->format('d/m/Y') }}</td>
                <td class="unit">{{$colegiatura->month->mes}}</td>
                <td class="unit">{{$colegiatura->nombre_pago}}</td>
                <td class="unit">${{number_format($colegiatura->monto, 2)}}</td>
                <td class="unit">${{number_format($colegiatura->descuento, 2)}}</td>
                <td class="unit">${{ number_format($colegiatura->total, 2) }}</td>
                {{-- <td class="desc" colspan="1"><p class="nombre">{{$colegiatura->student->nombre}} {{$colegiatura->student->apellido_paterno}} {{$colegiatura->student->apellido_materno}}</p></td>
                <td class="unit">{{$colegiatura->student->level->level}}</td>
                <td class="qty">{{$colegiatura->student->grade->grado}}° "{{$colegiatura->student->group->grupo}}"</td>
                <td class="unit">{{$colegiatura->month->mes}}</td> --}}
              </tr>
            @endforeach

        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TOTALES</td>
            <td colspan="1">${{ number_format($colegiaturas->sum('monto'), 2) }}</td>
            <td style="color:red" colspan="1">-${{ number_format($colegiaturas->sum('descuento'), 2) }}</td>
            <td colspan="1">
                <svg height="200px" width="200px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 227.096 227.096" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <polygon style="fill:#010002;" points="152.835,39.285 146.933,45.183 211.113,109.373 0,109.373 0,117.723 211.124,117.723 146.933,181.902 152.835,187.811 227.096,113.55 "></polygon> </g> </g> </g></svg>
                ${{ number_format($colegiaturas->sum('total'), 2) }}</td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Thank you!</div>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</div>
</html>
