@extends('../layouts/default')

@section('header')
    @include('header')
@stop

@section('navbar')
    @include('navbar')
@stop

@section('content')

    <section id="pros-cons-life-hacks">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if ($prosConsLifeHacks)
                        @if ($prosConsLifeHacks->image != '')
                            <div class="app-img">
                                <img src="{{ asset('/images/homedreambuilder/application/other-features/' . $prosConsLifeHacks->image) }}" alt="{{ $prosConsLifeHacks->question }}" />
                            </div>
                        @endif
                    <h1 class="text-center mt40 mb40">{{ $prosConsLifeHacks->question }}</h1>
                    <div class="more-thoughts">
                        <div class="pros-statement mb30">
                            <h2 class="mb5"><u>Pros</u></h2>
                            {{ (($prosConsLifeHacks->pros != '') ? $prosConsLifeHacks->pros : 'N/A') }}
                        </div>
                        <div class="cons-statement mb30">
                            <h2 class="mb5"><u>Cons</u></h2>
                            {{ (($prosConsLifeHacks->cons != '') ? $prosConsLifeHacks->cons : 'N/A') }}
                        </div>
                        <div class="life-hack-statement mb30">
                            <h2 class="mb5"><u>Life Hack</u></h2>
                            {{ (($prosConsLifeHacks->life_hacks != '') ? $prosConsLifeHacks->life_hacks : 'N/A') }}
                        </div>
                    </div>
                    @else
                        <style>
                            .full-height {
                                height: calc(80vh - 140px);
                            }

                            .vcenter-container {
                                display: table;
                            }

                            .vcenter {
                                display: table-cell;
                                vertical-align: middle;
                            }

                            h2 {
                                font-size: 48px;
                                font-weight: 700;
                                margin-top: -50px
                            }

                            .error-message,
                            .error-message > a {
                                font-size: 22px;
                                font-weight: 600;
                                margin-top: 5px;
                                margin-bottom: 10px
                            }

                            @media (max-height: 700px) {
                                .full-height {
                                    height: 450px;
                                }
                            }
                        </style>
                        <div class="full-height">
                            <div class="vcenter-container">
                                <div class="vcenter">
                                    <div class="container">
                                        <h2>That question does not exist</h2>
                                        <div class="error-message">
                                            Click <a href="{{ asset('/') }}" class="red">here</a> to get back to our <u>home</u>. <br/>
                                            Click <a href="{{ asset('/ready-to-dream') }}" class="blue">here</a> to go to the <u>application</u>.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@stop


@section('footer')
    @include('footer')
@stop