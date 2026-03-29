@extends('layouts.app')
@section('title', 'Certificat — Dev Learn')

@section('styles')
        @media print {
            .no-print { display: none !important; }
            body { background: #fff !important; }
            .certificate { box-shadow: none !important; border: 3px solid #1a1a2e !important; }
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            background: #1a1a2e;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
        }

        .no-print {
            margin-bottom: 20px;
            display: flex;
            gap: 12px;
        }

        .no-print a, .no-print button {
            padding: 10px 24px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            border: none;
            font-weight: bold;
        }

        .btn-back {
            background: #16213e;
            color: #eee;
        }

        .btn-print {
            background: #896f3d;
            color: #fff;
        }

        .btn-print:hover { background: #c73a52; }

        .certificate {
            background: #fff;
            width: 800px;
            max-width: 100%;
            padding: 60px 50px;
            border-radius: 4px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
            position: relative;
            color: #333;
        }

        .certificate::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border: 2px solid #c4a35a;
            border-radius: 2px;
            pointer-events: none;
        }

        .cert-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .cert-logo {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: #888;
            margin-bottom: 10px;
        }

        .cert-title {
            font-size: 36px;
            color: #1a1a2e;
            margin-bottom: 5px;
            font-weight: normal;
        }

        .cert-subtitle {
            font-size: 14px;
            color: #888;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .cert-divider {
            width: 80px;
            height: 3px;
            background: #c4a35a;
            margin: 25px auto;
        }

        .cert-body {
            text-align: center;
            line-height: 2;
            font-size: 16px;
            color: #555;
        }

        .cert-name {
            font-size: 32px;
            color: #1a1a2e;
            font-weight: bold;
            font-style: italic;
            margin: 10px 0;
        }

        .cert-score {
            display: inline-block;
            background: #1a1a2e;
            color: #c4a35a;
            padding: 8px 24px;
            border-radius: 30px;
            font-size: 20px;
            font-weight: bold;
            margin: 15px 0;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .cert-techs {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
            margin: 20px 0;
        }

        .cert-tech {
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            color: #fff;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .cert-footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .cert-footer-col {
            text-align: center;
            font-size: 12px;
            color: #888;
        }

        .cert-footer-col .value {
            font-size: 14px;
            color: #333;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .cert-id {
            text-align: center;
            margin-top: 15px;
            font-size: 11px;
            color: #bbb;
            font-family: 'Consolas', monospace;
        }
        @media(max-width:768px) {
            .certificate { padding:40px 28px; width:100%; }
            .cert-title { font-size:28px; }
            .cert-name { font-size:24px; }
            .cert-score { font-size:16px; padding:6px 18px; }
            .cert-footer { flex-direction:column; gap:16px; align-items:center; }
            .cert-techs { gap:6px; }
            .cert-tech { font-size:11px; padding:4px 10px; }
        }
        @media(max-width:480px) {
            .certificate { padding:30px 18px; }
            .cert-title { font-size:22px; }
            .cert-name { font-size:20px; }
            .cert-logo { font-size:12px; letter-spacing:2px; }
            .no-print { flex-direction:column; gap:8px; }
            .no-print a, .no-print button { font-size:12px; padding:8px 18px; }
        }
@endsection

@section('content')

<div class="no-print">
    <a href="/dashboard" class="btn-back">Retour au dashboard</a>
    <button class="btn-print" onclick="window.print()">Imprimer / Sauvegarder en PDF</button>
</div>

<div class="certificate">
    <div class="cert-header">
        <div class="cert-logo">Dev Learn — Plateforme d'apprentissage</div>
        <div class="cert-title">Certificat de Reussite</div>
        <div class="cert-subtitle">Examen Final</div>
    </div>

    <div class="cert-divider"></div>

    <div class="cert-body">
        <p>Ce certificat atteste que</p>
        <div class="cert-name">{{ $user->nom ?? $user->name }}</div>
        <p>a reussi l'examen final de la plateforme Dev Learn<br>avec le score de</p>
        <div class="cert-score">{{ $bestPct }}% ({{ $bestScore }}/{{ $total }})</div>

        <p style="margin-top:10px">Technologies validees :</p>
        <div class="cert-techs">
            @php
            $techs = [
                'qcm-cpp' => ['C++', '#00599C'],
                'qcm-html' => ['HTML', '#e44d26'],
                'qcm-css' => ['CSS', '#2965f1'],
                'qcm-js' => ['JavaScript', '#f0db4f'],
                'qcm-sql' => ['SQL', '#00BCD4'],
                'qcm-php' => ['PHP', '#8892BF'],
            ];
            @endphp
            @foreach($techs as $key => [$name, $color])
                @php $score_val = $techScores[$key] ?? 0; @endphp
                @if($score_val >= 60)
                    <span class="cert-tech" style="background:{{ $color }}">{{ $name }} ({{ $score_val }}%)</span>
                @endif
            @endforeach
        </div>
    </div>

    <div class="cert-footer">
        <div class="cert-footer-col">
            <div class="value">{{ date("d/m/Y") }}</div>
            <div>Date de delivrance</div>
        </div>
        <div class="cert-footer-col">
            <div class="value">Dev Learn</div>
            <div>Plateforme</div>
        </div>
    </div>

    <div class="cert-id">ID: CERT-{{ strtoupper(substr(md5(auth()->id() . 'qcm-exam' . $bestPct), 0, 12)) }}</div>
</div>

@endsection
