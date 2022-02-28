<?php

namespace App\Exports;

use App\Clave;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Responsable;

class Clave_Entre_FechasExport implements FromQuery, Responsable, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    /** @var null */
    private $fileName = null;
    public function __construct(string $tabla, string $fechaD, string $fechaH)
    {
        
        $this->fechaD = $fechaD;
        $this->fechaH = $fechaH;
        $this->modelo = ucwords( substr($tabla, 0, -1));
        $this->tabla =  $tabla;
        $this->setFileName();
        return $this;
    }

    public function query()
    {
        
        $downloadBusquedaentrefechas_xvehiculo = DB::table($this->tabla)
        ->join('vehiculos',  $this->tabla . '.vehiculo_id', '=', 'vehiculos.id')
        ->join('users',  $this->tabla . '.user_id', '=', 'users.id')
        ->join('gasolineras',  $this->tabla . '.gasolinera_id', '=', 'gasolineras.id')
        ->select($this->tabla . '.created_at','vehiculos.codigodis','placa','dolares','galones', $this->tabla . '.combustible','km_gasolinera','Orden','Factura','name','razonsocial')
        ->whereYear($this->tabla .'.created_at', '=', date('Y'))
        ->whereNull($this->tabla . '.deleted_at')
        ->whereBetween($this->tabla .'.created_at', array($this->fechaD, $this->fechaH))
        ->orderByDesc($this->tabla .'.created_at');
        return $downloadBusquedaentrefechas_xvehiculo;
    }

    public function setFileName(): void
    {
        $this->fileName = sprintf('consulta-export-%s.xlsx', now()->timestamp);
    }

    public function headings(): array
    {
        return [
            'Fecha',
            'Codigo_Vehiculo',
            'Placa',
            'Dolares',
            'Galones',
            'Combustible',
            'km_gasolinera',
            'Nro Orden',
            'Factura',
            'Conductor',
            'Gasolinera'
        ];
    }

   
}
