@extends('../layouts/default')

@section('header')
    @include('header')
    <style>

        .vcenter-container {
            display: table;
        }

        .vcenter {
            display: table-cell;
            vertical-align: middle;
        }

        h1 {
            font-size: 45px;
        }

        #top-10-table {
            margin-left: auto;
            margin-right: auto;
        }

        @media (max-width: 767px) {
            h1 {
                font-size: 30px;
            }
        }

        @media (max-width: 447px) {
            h1 {
                font-size: 24px;
            }
        }

        /*@media (max-height: 700px) {*/
            /*.full-height {*/
                /*height: 450px;*/
            /*}*/
        /*}*/
    </style>
@stop

@section('navbar')
    @include('navbar')
@stop

@section('content')

    <section id="thank-you" class="">
        <div class="container">
            <div class="full-height">
                <div class="vcenter-container">
                    <div class="vcenter">
                        <div class="container text-center">
                            <h1 class='mb30'>
                                CONGRATULATIONS!
                            </h1>
                            <p>
                                You just completed a very important step in your home buying journey. You will receive your
                                personal report as a PDF file at the email address you provided. We will be sending you
                                home buying information to help you along your journey.
                            </p>
                            <p>
                                If at anytime you no longer wish to receive the emails please feel free to "opt out."
                            </p>
                            <p>
                                Good luck and enjoy the adventure!  Soon you will be in your very own home.
                            </p>
                            <p>
                                Click <a href="{{ asset('/') }}" class="red">here</a> to go back to our home.
                            </p>
                            <div class="table-container mt60" id='top-10-table-container'>
                                <table class="table-bordered" id='top-10-table'>
                                    <thead>
                                    <tr>
                                        <th colspan="3" style="text-align: center">Your Top 10 Home Features</th>
                                    </tr>
                                    <tr>
                                        <th style='width:10%'></th>
                                        <th style="width:70%">Features</th>
                                        <th style="width:20%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for ($i = 10; $i > 0; $i--)
                                        <tr>
                                            <td>{{ $i }})</td>
                                            <td class="selected-feature" id="feature-{{ $i }}">{{ ((10 - $i < count($top10Features)) ? $top10Features[10 - $i] : '') }}</td>
                                            <td>
                                                @if (10 - $i < count($top10Features))
                                                {{ Application::moreThoughtsToolTip(
                                                    array(
                                                        'tag' => $questions[10 - $i]->tag,
                                                        'question' => $questions[10 - $i]->question,
                                                        'pros' => $questions[10 - $i]->pros,
                                                        'cons' => $questions[10 - $i]->cons,
                                                        'life-hacks' => $questions[10 - $i]->life_hacks,
                                                        'position' => 'right'
                                                    ))
                                                }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@section('footer')
    @include('footer')
@stop