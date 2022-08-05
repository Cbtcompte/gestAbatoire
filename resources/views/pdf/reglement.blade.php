<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Règlement de la facture</title>
    <style>
        @page {
            margin: 30px 50px 100px 50px;
        }

        #footer {
            position: fixed;
            left: 0px;
            bottom: -180px;
            right: 0px;
            height: 150px;
        }

        #footer .page:after {
            content: counter(page, upper-roman);
        }

    </style>
</head>

<body>
    <header>
        <div style="display:flex" id="header">
            @if (auth()->user()->societe->logo != null)
                <div>
                    <img src="{{ __('storage/') . auth()->user()->societe->logo }}" alt="image">
                </div>
            @endif

            <div class="row" style="text-align: center">
                <h3 style="font-weight: bolder; color:black; margin-bottom:5px">
                    {{ auth()->user()->societe->raisonSocial }}</h3>
                <span style="font-weight: bolder; color:black; margin-right:4%">IFU :
                    {{ auth()->user()->societe->ifu }}</span>
                <span style="font-weight: bolder; color:black">Tel :
                    {{ auth()->user()->societe->telephone }}</span><br>
                <span style="font-weight: bolder; color:black">Email :
                    {{ auth()->user()->societe->email }}</span><br>
            </div>
        </div>
        <hr>

        <div class="row" style="text-align:center">
            <h3 style="font-weight: bolder; color:black">Récapitulatif du règlement de la facture {{ $facture->id }}
            </h3>
            @if ($facture->payements->last()->reste == 0)
                <h1 style="background-color: green; color:white;font-size:25px; margin-left:30%; margin-right:30%">
                    {{ __('SOLDE') }}</h1>
            @elseif ($facture->payements->last()->reste != 0)
                <h1 style="background-color: red; color:white;font-size:25px; margin-left:30%; margin-right:30%">
                    {{ __('NON SOLDE') }}</h1>
            @endif
        </div>
        <div style="margin-left: 10%">
            <table style="width:100%">
                <tbody>
                    <tr>
                        <th style="text-align: left">Devise :
                        <td style="font-weight: normal">FCFA</td>
                        </th>
                        <th style="text-align: left">Numéro facture :
                        <td style="font-weight: normal">{{ $facture->id }}</td>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: left">Opérateur :
                        <td style="font-weight: normal">{{ $facture->user->name }}</td>
                        </th>
                        <th style="text-align: left">Code Opérateur :
                        <td style="font-weight: normal">{{ $facture->user_id }}</td>
                        </th>
                    </tr>
                    @if (isset($facture->client->name))
                        <tr>
                            <th style="text-align: left">Nom client :
                            <td style="font-weight: normal">{{ $facture->client->name }}</td>
                            </th>
                            <th style="text-align: left">Date :
                            <td style="font-weight: normal">{{ date('d/m/Y', strtotime($facture->created_at)) }}</td>
                            </th>
                        </tr>
                        <tr>
                            <th style="text-align: left">Téléphone :
                            <td style="font-weight: normal">{{ $facture->client->telephone }}</td>
                            </th>
                            <th style="text-align: left">Email :
                            <td style="font-weight: normal">{{ $facture->client->email }}</td>
                            </th>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </header><br>
    @php
        $i = 0;
    @endphp
    <table style="border:1px solid black; border-collapse:collapse; width:100%">
        <thead>
            <tr>
                <th style="padding:3px; border:1px solid black; border-collapse:collapse; width:5%">#</th>
                <th style="padding:3px; border:1px solid black; border-collapse:collapse; width:35%">Date de payement
                </th>
                <th style="padding:3px; border:1px solid black; border-collapse:collapse; width:20%">Montant payé</th>
                <th style="padding:3px; border:1px solid black; border-collapse:collapse; width:20%">Acompte</th>
                <th style="padding:3px; border:1px solid black; border-collapse:collapse; width:20%">Reste</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reglement as $value)
                <tr>
                    <td style="padding:3px; border:1px solid black; border-collapse:collapse">{{ ++$i }}</td>
                    <td style="padding:3px; border:1px solid black; border-collapse:collapse">
                        {{ Carbon\Carbon::parse($value->created_at)->locale('FR_fr')->isoFormat('LLLL') }} </td>
                    <td style="padding:3px; border:1px solid black; border-collapse:collapse; text-align:right">
                        {{ number_format($value->montant_paye, 0, '', '.') }}</td>
                    <td style="padding:3px; border:1px solid black; border-collapse:collapse; text-align:right">
                        {{ number_format($value->acompte, 0, '', '.') }}</td>
                    <td style="padding:3px; border:1px solid black; border-collapse:collapse; text-align:right">
                        {{ number_format($facture->montant - $value->acompte, 0, '', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-left:7%">
        <p><span style="font-weight : bolder">Montant à Payer : </span> {{ number_format($facture->montant,0,'','.')._(' FCFA') }}</span>
        <p><span style="font-weight : bolder">Montant Payé : </span>{{ number_format($facture->payements->last()->acompte,0,'','.')._(' FCFA') }}</span>
        <p><span style="font-weight : bolder">Reste : </span>{{ number_format($facture->montant - $facture->payements->last()->acompte,0,'','.')._(' FCFA') }}</span>
    </div>
    <div style="margin-left:70%">
        <h4 style="margin-left:5%; margin-bottom:40%">L'administrateur</h4>
        <h4>
            Madame ADINSI
        </h4>
    </div>
    <div id="footer">
        <hr>
        <div style="text-align: center">
            <p>{{ auth()->user()->societe->raisonSocial }}</p>
        </div>
    </div>
</body>

</html>
