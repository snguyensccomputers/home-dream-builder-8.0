@extends('../layouts/default')

@section('header')
    @include('header')
@stop

@section('navbar')
    @include('navbar')
@stop

@section('content')

    <section id="content">
        <div class="bg-img home-bg-img">
            <div class="hero-banner">
                <h1>HOME DREAM BUILDER</h1>
                <a class="btn btn-custom" href="{{ asset('/ready-to-dream') }}">Ready to Dream</a>
            </div>
        </div>
    </section>

    <section id="get-started" class="bg-lightblue">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="text-center">What is Home Dream Builder?</h2>
                    <p>
                        This is a tool that will help you in your home search, maybe spark some discussion with
                        anyone else who is part of this decision and help you visualize your next home. First you
                        will go through and pick out the most important things that matter in a home you would like
                        to own.
                    </p>
                    <p>
                        Next this program will allow you to pick out the top 10 most important things about your next
                        home. This tool will then send you an email with your full list and your narrowed top 10 list.
                    </p>
                    <p>
                        We will send you suggestions on options if a home has some of the options on your list but not
                        all. We will show ideas for your first home vs. your forever home. You can opt in or opt out for
                        emails that help you explore home buying ideas, financing tips, credit score tips, home
                        improvement ideas, gardening ideas, backyard and other entertainment areas, home tech tips.
                    </p>
                    <p>
                        To get started click <a href="{{ asset('/ready-to-dream') }}">"Ready to Dream"</a>.
                    </p>
                </div>
            </div>
        </div>
    </section>

@stop

@section('footer')
    @include('footer')
@stop