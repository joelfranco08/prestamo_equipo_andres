<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Préstamo #{{ $prestamo->id }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1e293b;
            margin: 15px;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #0284c7;
            padding-bottom: 12px;
            margin-bottom: 25px;
        }
        .header h1 {
            margin: 0;
            color: #0284c7;
            font-size: 22px;
            text-transform: uppercase;
        }
        .header p {
            margin: 4px 0 0 0;
            color: #64748b;
            font-size: 13px;
        }
        .section-title {
            background-color: #f0f9ff;
            color: #0369a1;
            padding: 6px 10px;
            font-size: 14px;
            font-weight: bold;
            margin-top: 15px;
            border-left: 4px solid #0284c7;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            margin-bottom: 15px;
        }
        table th, table td {
            border: 1px solid #e2e8f0;
            padding: 8px 10px;
            text-align: left;
            font-size: 13px;
        }
        table th {
            background-color: #f8fafc;
            color: #475569;
            width: 35%;
        }
        .badge {
            background-color: #e2e8f0;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 11px;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 8px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Reporte de Préstamo de Hardware</h1>
        <p>Sistema Automatizado de Inventario • Orden N° {{ $prestamo->id }}</p>
    </div>

    <div class="section-title">Detalles del Cronograma</div>
    <table>
        <tr>
            <th>Fecha de Préstamo:</th>
            <td>{{ $prestamo->fecha_prestamo }}</td>
        </tr>
        <tr>
            <th>Devolución Esperada:</th>
            <td>{{ $prestamo->fecha_devolucion_esperada }}</td>
        </tr>
        <tr>
            <th>Devolución Real:</th>
            <td>
                @if($prestamo->fecha_devolucion_real)
                    {{ $prestamo->fecha_devolucion_real }}
                @else
                    <span class="badge" style="background-color: #fee2e2; color: #991b1b;">Pendiente de Entrega</span>
                @endif
            </td>
        </tr>
    </table>

    <div class="section-title">Información del Solicitante</div>
    <table>
        <tr>
            <th>Nombre Completo:</th>
            <td>{{ $prestamo->solicitante->nombre ?? 'No asignado' }}</td>
        </tr>
        <tr>
            <th>Documento / Identificación:</th>
            <td>{{ $prestamo->solicitante->documento ?? 'Sin registro' }}</td>
        </tr>
    </table>

    <div class="section-title">Información del Hardware Asignado</div>
    <table>
        <tr>
            <th>Código de Inventario:</th>
            <td>{{ $prestamo->equipo->codigo ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Nombre del Dispositivo:</th>
            <td>{{ $prestamo->equipo->nombre ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Marca:</th>
            <td>{{ $prestamo->equipo->marca ?? 'N/A' }}</td>
        </tr>
    </table>

    @if($prestamo->observaciones_entrega)
        <div class="section-title">Observaciones de Entrega</div>
        <p style="font-size: 12px; padding: 5px 10px; background: #f8fafc; border: 1px solid #e2e8f0; margin-top: 8px;">
            {{ $prestamo->observaciones_entrega }}
        </p>
    @endif

    <div class="footer">
        Documento digital generado de forma institucional el {{ date('d/m/Y') }} a las {{ date('g:i a') }}
    </div>

</body>
</html>
