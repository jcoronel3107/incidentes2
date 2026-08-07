<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inspección - {{ $inspeccion->codigo_inspeccion }}</title>
    <style>
        body { font-family: 'Helvetica', Arial, sans-serif; font-size: 12px; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { color: #1a3c6e; font-size: 24px; margin: 0; }
        .header p { margin: 5px 0; color: #666; }
        .title { font-size: 16px; font-weight: bold; color: #1a3c6e; margin: 15px 0 10px 0; border-bottom: 1px solid #ccc; padding-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        table td { padding: 6px 10px; border: 1px solid #ddd; }
        .label { font-weight: bold; background-color: #f2f2f2; width: 30%; }
        .value { width: 70%; }
        .observations-box { background-color: #f9f9f9; border: 1px solid #ddd; padding: 10px; margin: 5px 0; border-radius: 4px; min-height: 30px; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #999; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Sistema de Incidentes</h1>
        <p><strong>Código:</strong> {{ $inspeccion->codigo_inspeccion }}</p>
        <p><strong>Fecha de Emisión:</strong> {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <div class="title">INFORMACIÓN GENERAL</div>
    <table>
        <tr><td class="label">Fecha de Inspección</td><td class="value">{{ $inspeccion->fecha_inspeccion->format('d/m/Y') }}</td></tr>
        <tr><td class="label">Tipo de Inspección</td><td class="value">{{ ucfirst($inspeccion->tipo_inspeccion) }}</td></tr>
        <tr><td class="label">Lugar</td><td class="value">{{ $inspeccion->lugar }}</td></tr>
        <tr><td class="label">Dirección</td><td class="value">{{ $inspeccion->direccion ?? 'N/A' }}</td></tr>
        <tr><td class="label">Ciudad</td><td class="value">{{ $inspeccion->ciudad ?? 'N/A' }}</td></tr>
        <tr><td class="label">Provincia</td><td class="value">{{ $inspeccion->provincia ?? 'N/A' }}</td></tr>
    </table>

    <div class="title">INFORMACIÓN DEL INSPECTOR</div>
    <table>
        <tr><td class="label">Inspector</td><td class="value">{{ $inspeccion->inspector->name ?? 'N/A' }}</td></tr>
        <tr><td class="label">Cargo</td><td class="value">{{ $inspeccion->cargo_inspector ?? 'N/A' }}</td></tr>
    </table>

    <div class="title">RESULTADOS</div>
    <table>
        <tr><td class="label">Estado</td><td class="value">{{ ucfirst($inspeccion->estado) }}</td></tr>
        <tr><td class="label">Nivel de Riesgo</td><td class="value">{{ $inspeccion->nivel_riesgo ?? 'N/A' }}</td></tr>
        <tr><td class="label">Fecha Próxima Inspección</td><td class="value">{{ $inspeccion->fecha_proxima_inspeccion ? $inspeccion->fecha_proxima_inspeccion->format('d/m/Y') : 'N/A' }}</td></tr>
        <tr><td class="label">Cumple Normativas</td><td class="value">{{ $inspeccion->cumple_normativas ? 'Sí' : 'No' }}</td></tr>
    </table>

    <div class="title">OBSERVACIONES</div>
    <div class="observations-box">{{ $inspeccion->observaciones ?? 'Sin observaciones' }}</div>

    <div class="title">RECOMENDACIONES</div>
    <div class="observations-box">{{ $inspeccion->recomendaciones ?? 'Sin recomendaciones' }}</div>

    <div class="footer">Generado por el Sistema de Incidentes {{ date('Y') }}</div>
</body>
</html>