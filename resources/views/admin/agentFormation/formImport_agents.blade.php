@extends('layouts/master')

@section('content')

    <div class="block-header">

        <ol class="breadcrumb breadcrumb-col-orange">

            <li><a href="{{route('home')}}">Accueil</a></li>

            <li><a href="{{ route('domains') }}">Gestion des Agents</a></li>

            <li class="active">IMPORTER DES AGENTS</li>

        </ol>



        <small>Afin d'importer des domaines, choisissez un fichier excel puis cliquer sur le bouton
            <strong>Importer</strong></small>

    </div>



    <div class="row clearfix">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="card">

                <div class="header">

                    <h2>IMPORTER DES AGENTS</h2>

                </div>

                <div class="body">

                    @if (session('success'))

                        <div class="alert bg-green alert-dismissible" role="alert">

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>

                            Importation terminee avec succes

                        </div>

                    @elseif(session('unit'))

                        <div class="alert bg-warning alert-dismissible" role="alert">

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>

                            Le format du fichier excel est incorrecte, <strong>il manque la colonne Unit</strong>

                        </div>

                    @elseif(session('validation'))

                        <div class="alert bg-danger alert-dismissible" role="alert">

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>

                            Erreur de validation...Veuillez rééssayer avec un fichier Xlsx ou Xls<br>

                        </div>

                    @elseif(session('warning'))

                        <div class="alert bg-warning alert-dismissible" role="alert">

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>

                            Des erreurs sont survenues lors du traitement du fichier<br>

                            IL se pourrai qu'il y ait deux agents du même matricule.<br>

                            Veuillez voir ci-joint le fichier contenant les lignes non enregistrees<br>

                        </div>
                    @elseif(session('nomenclatureError'))

                        <div class="alert bg-warning alert-dismissible" role="alert">

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>

                                    Des erreurs sont survenues lors du traitement du fichier.<br> 

                                    <strong>{{ session('nomenclatureError') }}</strong> <br>
                            
                            Les champs doivent être dans le même ordre que dans l'examplaire. <em>Générer un exemplaire pour plus de précision.</em> <br>
                            Veuillez les corriger puis réessayer.
                        </div>

                    @endif

                    <form id="form_advanced_validation" method="POST"
                        action="{{ route('agentFormation.import') }}" enctype="multipart/form-data">

                        {{ csrf_field() }}



                        <div class="form-group form-float">

                            <div class="form-line">

                                <input type="file" class="form-control" name="importfile" required>

                                {{-- <label class="form-label">Dataset Name</label> --}}

                            </div>

                            <div class="help-info"></div>

                        </div>



                        <button class="btn btn-primary waves-effect" type="submit">IMPORTER</button>

                        <a href="{{ route('agentFormation.data') }}" class="btn btn-warning waves-effect">Liste des Agents</a>



                        @if(session('examplaire'))
                            @php
                                $examplaire = session('examplaire');
                            @endphp
                            <a href="{{ url($examplaire) }}" class="btn btn-secondary waves-effect">Télécharger l'examplaire</a>
                        @else
                            <a href="{{ route('agentFormation.genererExp') }}" class="btn btn-secondary waves-effect">Générer un examplaire</a>
                        @endif

                        @if (session('path'))

                            @php
                                
                                $path = session('path');
                                
                            @endphp

                            <a href="{{ url($path) }}" class="btn btn-secondary waves-effect">Telecharger le fichier</a>

                        @endif

                    </form>

                </div>

            </div>

        </div>

    </div>



@endsection
