<?php

namespace App\Observers;

use App\Models\Colegiatura;

class ColegiaturaObserver
{
    public function creating(Colegiatura $folio): void
    {
              // Asignar un folio único (Ejemplo: Año+ID)
              $ultimoRecibo = Colegiatura::latest('id')->first();
              $folioAnterior = $ultimoRecibo ? intval(substr($ultimoRecibo->folio, -4)) : 0;
              $nuevoFolio = str_pad($folioAnterior + 1, 5, '0', STR_PAD_LEFT);

              $folio->folio = date('Y') . '-' . $nuevoFolio;
    }
}
