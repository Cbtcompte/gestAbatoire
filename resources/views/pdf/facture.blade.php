<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Facture de vente</title>
        <style>
            @page { margin: 30px 50px 100px 50px; }
            #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px;}
            #footer .page:after { content: counter(page, upper-roman); }
          </style>
    </head>
    <body style="font-size:90%">
        <header>
            <div style="display:flex" id="header">
                @if(auth()->user()->societe->logo !=null)
                    <div>
                        <img src="{{ __('storage/').auth()->user()->societe->logo }}" alt="image">
                    </div>
                @endif

                <div class="row" style="text-align: center">
                    <h3 style="font-weight: bolder; color:black; margin-bottom:5px">{{ auth()->user()->societe->raisonSocial }}</h3>
                    <span style="font-weight: bolder; color:black; margin-right:4%">IFU : {{ auth()->user()->societe->ifu }}</span>
                    <span style="font-weight: bolder; color:black">Tel : {{ auth()->user()->societe->telephone }}</span><br>
                    <span style="font-weight: bolder; color:black">Email : {{  auth()->user()->societe->email }}</span><br>
                </div>
            </div>
            <hr>

                <div class="row" style="text-align:center">
                    <h3 style="font-weight: bolder; color:black">FACTURE DE VENTE </h3>
                </div>
            <div style="margin-left: 0%">
                <table style="width:100%">
                    <tbody>
                        <tr>
                            <th style="text-align: left">Devise : <td style="font-weight: normal">FCFA</td></th>
                            <th style="text-align: left">Numéro facture : <td style="font-weight: normal">{{ $facture->id }}</td></th>
                        </tr>
                        <tr>
                            <th style="text-align: left">Opérateur : <td style="font-weight: normal">{{ $facture->user->name}}</td></th>
                            <th style="text-align: left">Code Opérateur : <td style="font-weight: normal">{{ $facture->user_id}}</td></th>
                        </tr>
                        @if(isset($fact->client->nom))
                            <tr>
                                <th style="text-align: left">Nom client : <td style="font-weight: normal">{{ $facture->client->name }}</td></th>
                                <th style="text-align: left">Date : <td style="font-weight: normal">{{ date('d/m/Y', strtotime($facture->created_at)) }}</td></th>
                            </tr>
                            <tr>
                                <th style="text-align: left">Téléphone : <td style="font-weight: normal">{{ $facture->client->telephone }}</td></th>
                                <th style="text-align: left">Email : <td style="font-weight: normal">{{ $facture->client->email }}</td></th>
                                {{-- <th style="text-align: left">AIB : <td style="font-weight: normal">{{ $fact->client->aib }}</td></th> --}}
                            </tr>
                            {{-- <tr>
                                <th style="text-align: left">IFU : <td style="font-weight: normal">{{ $fact->client->ifu }}</td></th>
                            </tr> --}}
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
                    <th style="padding:3px; border:1px solid black; border-collapse:collapse">#</th>
                    <th style="padding:3px; border:1px solid black; border-collapse:collapse; width:46%">Objet</th>
                    <th style="padding:3px; border:1px solid black; border-collapse:collapse; width:8%">Qte</th>
                    <th style="padding:3px; border:1px solid black; border-collapse:collapse; width:13%">P.U.</th>
                    <th style="padding:3px; border:1px solid black; border-collapse:collapse; width:15%">Montant</th>
                </tr>
            </thead>
            <tbody>
                @foreach($temp as $value)
                    <tr>
                        <td style="padding:3px; border:1px solid black; border-collapse:collapse">{{ ++$i }}</td>
                        <td style="padding:3px; border:1px solid black; border-collapse:collapse">{{ $value->sousArticle->libelle }} </td>
                        <td style="padding:3px; border:1px solid black; border-collapse:collapse; text-align:right">{{ $value->qte }}</td>
                        <td style="padding:3px; border:1px solid black; border-collapse:collapse; text-align:right">{{ number_format($value->prix,0,'','.') }}</td>
                        <td style="padding:3px; border:1px solid black; border-collapse:collapse; text-align:right">{{ number_format($value->montant,0,'','.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td  rowspan="4" colspan="2" style="padding:3px; border:1px solid black; border-collapse:collapse"></td>
                    <td  colspan="2" style="padding:3px; border:1px solid black; border-collapse:collapse; text-align:right; font-weight: bolder">Total: </td>
                    <td  style="padding:3px; border:1px solid black; border-collapse:collapse; text-align:right"> {{ number_format($facture->montant,0,'', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="padding:3px; border:1px solid black; border-collapse:collapse;font-weight: bolder; text-align:right">Net à payer: </td>
                    <td  style="padding:3px; border:1px solid black; border-collapse:collapse; text-align:right">{{ number_format($facture->montant, 0,'','.') }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="padding:3px; border:1px solid black; border-collapse:collapse;font-weight: bolder; text-align:right">Acompte: </td>
                    <td  style="padding:3px; border:1px solid black; border-collapse:collapse; text-align:right">{{ number_format($payement->acompte, 0,'','.') }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="padding:3px; border:1px solid black; border-collapse:collapse;font-weight: bolder; text-align:right">Reste: </td>
                    <td  style="padding:3px; border:1px solid black; border-collapse:collapse; text-align:right">{{ number_format($payement->reste, 0,'','.') }}</td>
                </tr>
                <tr>
                    <td colspan="5" style="border:1px solid black; border-collapse:collapse">
                        <p style="text-align:center; font-weight:bolder; font-size:80%">ARRETÉ LA PRESENTE FACTURE A LA SOMME DE {{ Str::upper($lettre_chiffre).__(' (').number_format($facture->montant,0,'','.').__(')') }}</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="margin-left:70%">
                <h4 style="margin-left:5%; margin-bottom:20%">L'administrateur</h4>
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
