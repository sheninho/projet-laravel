@extends('layouts.master')

@section('main')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<div class="row">

    @php
        $couleur = ($compteurs['en_cours_sp'] != 0) ? 'primary' : 'warning';
    @endphp
    <div class="col-md-6 col-lg-3">
        <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-{{$couleur}} border-{{$couleur}} card">
            <div class="widget-chat-wrapper-outer">
                <div class="widget-chart-content">
                    <div class="widget-title opacity-5 text-uppercase">Sécrétaire Permanent</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-{{$couleur}} pr-2">
                                    <i class="fa fa-angle-up"></i>
                                </span>
                                {{$compteurs['en_cours_sp']}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $couleur = ($compteurs['en_cours_dir'] != 0) ? 'primary' : 'warning';
    @endphp
    <div class="col-md-6 col-lg-3">
        <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-{{$couleur}} border-{{$couleur}} card">
            <div class="widget-chat-wrapper-outer">
                <div class="widget-chart-content">
                    <div class="widget-title opacity-5 text-uppercase">Directeur</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-{{$couleur}} pr-2">
                                    <i class="fa fa-angle-up"></i>
                                </span>
                               {{$compteurs['en_cours_dir']}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $couleur = ($compteurs['en_cours_scolarite'] != 0) ? 'primary' : 'warning';
    @endphp
    <div class="col-md-6 col-lg-3">
        <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-{{$couleur}} border-{{$couleur}} card">
            <div class="widget-chat-wrapper-outer">
                <div class="widget-chart-content">
                    <div class="widget-title opacity-5 text-uppercase">Scolarité</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-{{$couleur}} pr-2">
                                    <i class="fa fa-angle-up"></i>
                                </span>
                                {{$compteurs['en_cours_scolarite']}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $couleur = ($compteurs['validate'] != 0) ? 'success' : 'warning';
    @endphp
    <div class="col-md-6 col-lg-3">
        <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-{{$couleur}} border-{{$couleur}} card">
            <div class="widget-chat-wrapper-outer">
                <div class="widget-chart-content">
                    <div class="widget-title opacity-5 text-uppercase">Validé</div>
                    <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                            <div>
                                <span class="opacity-10 text-{{$couleur}} pr-2">
                                    <i class="fa fa-angle-up"></i>
                                </span>
                                {{$compteurs['validate']}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-card mb-3 card">
    <div class="card-body">
        <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Date d'arrivée</th>
                    <th>Expéditeur</th>
                    <th>Instructions du SP</th>
                    <th>Instructions du directeur</th>
                    <th>Décision de la scolarité</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fiches as $fiche)
                <tr>
                    <td>{{$fiche->id}}</td>
                    <td>{{date('d-m-Y', strtotime($fiche->date_arrivee))}}</td>
                    <td>{{$fiche->nom_exp . " ". $fiche->prenom_exp}}</td>

                    @if ($fiche->sp_instructions == "")
                        <td><a name="" class="btn btn-primary text-white" href="{{ route('fiche.edit', $fiche->id) }}" role="button">En cours</a></td>
                        <td><a name="" id="" class="btn btn-warning text-white" href="#" role="button">NULL</a></td>
                        <td><a name="" id="" class="btn btn-warning text-white" href="#" role="button">NULL</a></td>
                        <td><a name="" id="" class="btn btn-warning text-white" href="#" role="button">En cours</a></td>
                    @endif

                    @if ($fiche->sp_instructions != "" && $fiche->dir_instructions == "")
                        <td><a name="" id="" class="btn btn-success text-white" href="#" role="button">{{$fiche->sp_instructions}}</a></td>
                        <td><a name="" id="" class="btn btn-primary text-white" href="{{ route('fiche.edit', $fiche->id) }}" role="button">En cours</a></td>
                        <td><a name="" id="" class="btn btn-warning text-white" href="#" role="button">NULL</a></td>
                        <td><a name="" id="" class="btn btn-warning text-white" href="#" role="button">En cours</a></td>
                    @endif

                    @if ($fiche->sp_instructions != "" && $fiche->dir_instructions != "" && $fiche->proposition == "")
                        <td><a name="" id="" class="btn btn-success text-white" href="#" role="button">{{$fiche->sp_instructions}}</a></td>
                        <td><a name="" id="" class="btn btn-success text-white" href="#" role="button">{{$fiche->dir_instructions}}</a></td>
                        <td><a name="" id="" class="btn btn-primary text-white" href="{{ route('fiche.edit', $fiche->id) }}" role="button">En cours</a></td>
                        <td><a name="" id="" class="btn btn-warning text-white" href="#" role="button">En cours</a></td>
                    @endif

                    @if ($fiche->sp_instructions != "" && $fiche->dir_instructions != "" && $fiche->proposition != "")
                        <td><a name="" id="" class="btn btn-success text-white" href="#" role="button">{{$fiche->sp_instructions}}</a></td>
                        <td><a name="" id="" class="btn btn-success text-white" href="#" role="button">{{$fiche->dir_instructions}}</a></td>
                        <td><a name="" id="" class="btn btn-success text-white" href="#" role="button">{{$fiche->proposition}}</a></td>
                        <td><a name="" id="" class="btn btn-success text-white" href="#" role="button">Terminé</a></td>
                    @endif

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
