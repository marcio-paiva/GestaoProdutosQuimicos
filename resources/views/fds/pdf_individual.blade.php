<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.5; }
        .header { border-bottom: 2px solid #1e3a8a; padding-bottom: 10px; margin-bottom: 20px; }
        .title { font-size: 22px; font-weight: bold; color: #1e3a8a; text-transform: uppercase; }
        .section { margin-bottom: 20px; border: 1px solid #eee; padding: 15px; border-radius: 5px; }
        .section-title { font-weight: bold; font-size: 14px; border-bottom: 1px solid #1e3a8a; color: #1e3a8a; margin-bottom: 10px; padding-bottom: 5px; text-transform: uppercase; }
        .grid { width: 100%; }
        .label { font-weight: bold; color: #555; }
        .ghs-badge { background: #f3f4f6; padding: 5px 10px; display: inline-block; margin-right: 5px; border-radius: 3px; font-size: 10px; font-weight: bold; border: 1px solid #ddd; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #999; padding-top: 10px; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Ficha de Dados de Segurança (FDS)</div>
        <div style="font-size: 12px;">Produto: <strong>{{ $product->name }}</strong></div>
    </div>

    <div class="section">
        <div class="section-title">1. Identificação do Produto e da Empresa</div>
        <table class="grid">
            <tr>
                <td width="50%"><span class="label">Nome Químico:</span> {{ $product->name }}</td>
                <td width="50%"><span class="label">Número CAS:</span> {{ $product->cas_number ?? 'Não informado' }}</td>
            </tr>
            <tr>
                <td><span class="label">Fórmula:</span> {{ $product->formula ?? 'N/A' }}</td>
                <td><span class="label">Nível de Risco:</span> {{ $product->risk_level }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">2. Identificação de Perigos (GHS)</div>
        <div style="margin-top: 10px;">
            @if($product->pictograms && is_array($product->pictograms))
                @foreach($product->pictograms as $pic)
                    <span class="ghs-badge">{{ strtoupper($pic) }}</span>
                @endforeach
            @else
                <span>Produto não classificado como perigoso.</span>
            @endif
        </div>
    </div>

    <div class="section">
        <div class="section-title">3. Medidas de Segurança e Precauções</div>
        <p style="white-space: pre-line;">{{ $product->safety_precautions ?? 'Nenhuma precaução específica informada.' }}</p>
    </div>

    <div class="section">
        <div class="section-title">4. Outras Informações</div>
        <table class="grid">
            <tr>
                <td><span class="label">Descrição:</span><br>{{ $product->description ?? 'Sem descrição adicional.' }}</td>
            </tr>
            <tr>
                <td style="padding-top: 10px;"><span class="label">Última Revisão da FDS:</span> {{ $product->fds_revision_date ? $product->fds_revision_date->format('d/m/Y') : 'Pendente' }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        Este documento foi gerado automaticamente pelo Sistema de Gestão de Produtos Químicos em {{ date('d/m/Y H:i') }}
    </div>
</body>
</html>