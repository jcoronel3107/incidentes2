<?php

namespace App\Http\Controllers;

use App\Inspeccion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InspeccionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $inspecciones = Inspeccion::with('inspector')->latest()->paginate(10);
        return view('inspeccion.index', compact('inspecciones'));
    }

    public function create()
    {
        $inspectors = User::all();
        return view('inspeccion.create', compact('inspectors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha_inspeccion' => 'required|date',
            'tipo_inspeccion' => 'required|string|max:255',
            'lugar' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'inspector_id' => 'required|exists:users,id',
            'cargo_inspector' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
            'recomendaciones' => 'nullable|string',
            'estado' => 'required|in:pendiente,en_progreso,completada,aprobada,rechazada',
            'nivel_riesgo' => 'nullable|in:bajo,medio,alto,critico',
            'fecha_proxima_inspeccion' => 'nullable|date|after:fecha_inspeccion',
            'cumple_normativas' => 'nullable|boolean',
        ]);

        $inspeccion = Inspeccion::create([
            'codigo_inspeccion' => 'INS-' . date('Ymd') . '-' . Str::random(6),
            'fecha_inspeccion' => $request->fecha_inspeccion,
            'tipo_inspeccion' => $request->tipo_inspeccion,
            'lugar' => $request->lugar,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'provincia' => $request->provincia,
            'inspector_id' => $request->inspector_id,
            'cargo_inspector' => $request->cargo_inspector,
            'observaciones' => $request->observaciones,
            'recomendaciones' => $request->recomendaciones,
            'estado' => $request->estado,
            'nivel_riesgo' => $request->nivel_riesgo,
            'fecha_proxima_inspeccion' => $request->fecha_proxima_inspeccion,
            'cumple_normativas' => $request->has('cumple_normativas'),
        ]);

        return redirect()->route('inspeccion.index')
            ->with('success', 'Inspección creada exitosamente. Código: ' . $inspeccion->codigo_inspeccion);
    }

    public function show($id)
    {
        $inspeccion = Inspeccion::with('inspector')->findOrFail($id);
        return view('inspeccion.show', compact('inspeccion'));
    }

    public function edit($id)
    {
        $inspeccion = Inspeccion::findOrFail($id);
        $inspectors = User::all();
        return view('inspeccion.edit', compact('inspeccion', 'inspectors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_inspeccion' => 'required|date',
            'tipo_inspeccion' => 'required|string|max:255',
            'lugar' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'ciudad' => 'nullable|string|max:255',
            'provincia' => 'nullable|string|max:255',
            'inspector_id' => 'required|exists:users,id',
            'cargo_inspector' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
            'recomendaciones' => 'nullable|string',
            'estado' => 'required|in:pendiente,en_progreso,completada,aprobada,rechazada',
            'nivel_riesgo' => 'nullable|in:bajo,medio,alto,critico',
            'fecha_proxima_inspeccion' => 'nullable|date|after:fecha_inspeccion',
            'cumple_normativas' => 'nullable|boolean',
        ]);

        $inspeccion = Inspeccion::findOrFail($id);
        $inspeccion->update([
            'fecha_inspeccion' => $request->fecha_inspeccion,
            'tipo_inspeccion' => $request->tipo_inspeccion,
            'lugar' => $request->lugar,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'provincia' => $request->provincia,
            'inspector_id' => $request->inspector_id,
            'cargo_inspector' => $request->cargo_inspector,
            'observaciones' => $request->observaciones,
            'recomendaciones' => $request->recomendaciones,
            'estado' => $request->estado,
            'nivel_riesgo' => $request->nivel_riesgo,
            'fecha_proxima_inspeccion' => $request->fecha_proxima_inspeccion,
            'cumple_normativas' => $request->has('cumple_normativas'),
        ]);

        return redirect()->route('inspeccion.index')
            ->with('success', 'Inspección actualizada exitosamente');
    }

    public function destroy($id)
    {
        $inspeccion = Inspeccion::findOrFail($id);
        $inspeccion->delete();
        return redirect()->route('inspeccion.index')
            ->with('success', 'Inspección eliminada exitosamente');
    }

        public function exportPdf($id)
    {
        try {
            $inspeccion = Inspeccion::with('inspector')->findOrFail($id);
            
            // Crear PDF con FPDF
            $pdf = new \FPDF('P', 'mm', 'A4');
            $pdf->AddPage();
            $pdf->SetMargins(15, 15, 15);
            
            // Título
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(180, 10, 'INSPECCION', 0, 1, 'C');
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 8, 'Codigo: ' . $inspeccion->codigo_inspeccion, 0, 1, 'C');
            $pdf->Ln(5);
            
            // Línea separadora
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->Line(15, 40, 195, 40);
            $pdf->Ln(5);
            
            // DATOS BASICOS
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 8, 'DATOS BASICOS', 0, 1, 'L');
            $pdf->SetFont('Arial', '', 11);
            
            $pdf->Cell(50, 8, 'Fecha Inspeccion:', 0, 0);
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->Cell(130, 8, $inspeccion->fecha_inspeccion->format('d/m/Y'), 0, 1);
            
            $pdf->SetFont('Arial', '', 11);
            $pdf->Cell(50, 8, 'Tipo Inspeccion:', 0, 0);
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->Cell(130, 8, ucfirst($inspeccion->tipo_inspeccion), 0, 1);
            
            $pdf->SetFont('Arial', '', 11);
            $pdf->Cell(50, 8, 'Lugar:', 0, 0);
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->Cell(130, 8, $inspeccion->lugar, 0, 1);
            
            if ($inspeccion->direccion) {
                $pdf->SetFont('Arial', '', 11);
                $pdf->Cell(50, 8, 'Direccion:', 0, 0);
                $pdf->SetFont('Arial', 'B', 11);
                $pdf->Cell(130, 8, $inspeccion->direccion, 0, 1);
            }
            
            $pdf->Ln(3);
            
            // INSPECTOR
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 8, 'INSPECTOR', 0, 1, 'L');
            $pdf->SetFont('Arial', '', 11);
            
            $pdf->Cell(50, 8, 'Inspector:', 0, 0);
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->Cell(130, 8, $inspeccion->inspector->name ?? 'N/A', 0, 1);
            
            $pdf->Ln(3);
            
            // ESTADO
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(180, 8, 'ESTADO', 0, 1, 'L');
            $pdf->SetFont('Arial', '', 11);
            
            $pdf->Cell(50, 8, 'Estado:', 0, 0);
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->Cell(130, 8, ucfirst($inspeccion->estado), 0, 1);
            
            $pdf->Cell(50, 8, 'Cumple Normativas:', 0, 0);
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->Cell(130, 8, $inspeccion->cumple_normativas ? 'SI' : 'NO', 0, 1);
            
            $pdf->Ln(3);
            
            // OBSERVACIONES
            if (!empty($inspeccion->observaciones)) {
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(180, 8, 'OBSERVACIONES', 0, 1, 'L');
                $pdf->SetFont('Arial', '', 11);
                // Usar MultiCell para texto largo
                $pdf->MultiCell(180, 6, $inspeccion->observaciones, 0, 'L');
                $pdf->Ln(2);
            }
            
            // RECOMENDACIONES
            if (!empty($inspeccion->recomendaciones)) {
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(180, 8, 'RECOMENDACIONES', 0, 1, 'L');
                $pdf->SetFont('Arial', '', 11);
                $pdf->MultiCell(180, 6, $inspeccion->recomendaciones, 0, 'L');
            }
            
            // Pie de página
            $pdf->SetY(-15);
            $pdf->SetFont('Arial', 'I', 8);
            $pdf->Cell(180, 5, 'Documento generado por el Sistema de Incidentes - ' . date('Y'), 0, 0, 'C');
            
            // Guardar en archivo temporal
            $tempFile = storage_path('app/temp_pdf_' . uniqid() . '.pdf');
            $pdf->Output('F', $tempFile);
            
            // Leer el archivo
            $content = file_get_contents($tempFile);
            
            // Eliminar archivo temporal
            @unlink($tempFile);
            
            return response($content, 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="inspeccion-' . $inspeccion->codigo_inspeccion . '.pdf"');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Error al generar PDF: ' . $e->getMessage());
        }
    }
}