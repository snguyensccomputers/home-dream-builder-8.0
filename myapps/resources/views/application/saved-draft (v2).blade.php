@extends('../layouts/default')
<?php

Use App\Models\Application;

?>
@section('header')
    @include('header')
    <link rel="canonical" href="{{ asset('/ready-to-dream') }}" />
@stop

@section('navbar')
    @include('navbar')
@stop

@section('content')

    <section id="application" class="@if ($savedDraft->status != 1)app-bg-img @endif">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if ($savedDraft->status == 1)
                        <section id="completed-message">
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

                                @media (max-height: 700px) {
                                    .full-height {
                                        height: 450px;
                                    }
                                }
                            </style>
                            <div class="full-height">
                                <div class="vcenter-container">
                                    <div class="vcenter">
                                        <div class="container text-center">
                                            <h3 class='mb60'>
                                                This application has already been completed.
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @else
                    {{ Form::open(['url' => 'confirmation', 'name' => 'ready-to-dream-form', 'class' => 'rtd-form ' . (($savedDraft->left_at == 'review') ? 'review' : '') ]) }}
                    <input type='hidden' name='form-id' value='{{ $application->id }}' />
                    <input type='hidden' name='status' value='initializing' />
                    <input type='hidden' name='left-at' value='{{ $savedDraft->left_at }}' />

                    <?php $ct = 1; ?>
                    <?php $questionNum = 1; ?>



                    @if ($fixedQuestions[2]->active == 1)
                    <section id="current-amount" class='{{ (($savedDraft->left_at == "current-amount") ? 'active' : '') }}'>
                        <div class="container">
                            <div class="text-center mb40">
                                {!! Application::moreThoughtsToolTip(
                                    array(
                                        'ct' => $ct,
                                        'tag' => $fixedQuestions[2]->tag,
                                        'question' => $fixedQuestions[2]->question,
                                        'pros' => $fixedQuestions[2]->pros,
                                        'cons' => $fixedQuestions[2]->cons,
                                        'life-hacks' => $fixedQuestions[2]->life_hacks
                                    ))
                                !!}
                            </div>

                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[2]->question }}</h2>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="slider-value"><span>{{ $questionsAndAnswers->{'current-amount'} }}</span></div>
                                    <div class="slider-container">
                                        <span class="minmax-value">$0</span>
                                        <input type="hidden" name="current-amount" value="{{ $questionsAndAnswers->{'current-amount'} }}"/>
                                        <input type="text"
                                               name="current-amount-slider"
                                               class="slider slider-horizontal"
                                               id="current-amount-slider"
                                               data-ui-slider=""
                                               data-slider-min="0"
                                               data-slider-max="21"
                                               data-slider-value="0"
                                               data-slider-tooltip="disable">
                                        <span class="minmax-value">$85,000+</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <div class="btn btn-lightbrown prev">Previous</div>
                                    <div class="btn btn-custom next">Next</div>
                                    <div class="btn btn-custom-o review">Finish</div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <input type="submit" name="save-again" class="btn btn-bluegrey save" value="Save as Draft">
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[3]->active == 1)
                    <section id="dwelling-types" class='multiple-choices {{ (($savedDraft->left_at == "dwelling-types") ? 'active' : '') }}'>
                        <div class="container">
                            <div class="text-center mb40">
                                {!! Application::moreThoughtsToolTip(
                                    array(
                                        'ct' => $ct,
                                        'tag' => $fixedQuestions[3]->tag,
                                        'question' => $fixedQuestions[3]->question,
                                        'pros' => $fixedQuestions[3]->pros,
                                        'cons' => $fixedQuestions[3]->cons,
                                        'life-hacks' => $fixedQuestions[3]->life_hacks
                                    ))
                                !!}
                            </div>

                            <input type="hidden" name="dwelling-types" value="{{ $questionsAndAnswers->{'dwelling-types'} }}" />
                            <div class="text-center ft-700">* You can select multiple dwelling types</div>
                            <h2>{{ $questionNum++ }}. Dwelling Type</h2>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/dwelling-type/single-family.jpg') }}" alt="Single Family" class="{{ (strpos($questionsAndAnswers->{'dwelling-types'}, 'Single Family') !== false) ? 'selected' : '' }}"/>
                                        <h3>Single Family</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/dwelling-type/patio.jpg') }}" alt="Patio Home" class="{{ (strpos($questionsAndAnswers->{'dwelling-types'}, 'Patio Home') !== false) ? 'selected' : '' }}"/>
                                        <h3>Patio Home</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/dwelling-type/townhome.jpg') }}" alt="Townhome" class="{{ (strpos($questionsAndAnswers->{'dwelling-types'}, 'Townhome') !== false) ? 'selected' : '' }}"/>
                                        <h3>Townhome</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/dwelling-type/condo.jpg') }}" alt="Condo" class="{{ (strpos($questionsAndAnswers->{'dwelling-types'}, 'Condo') !== false) ? 'selected' : '' }}"/>
                                        <h3>Condo</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/dwelling-type/manufactured-home.jpg') }}" alt="Manufactured" class="{{ (strpos($questionsAndAnswers->{'dwelling-types'}, 'Manufactured') !== false) ? 'selected' : '' }}"/>
                                        <h3>Manufactured</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/dwelling-type/twin-house.jpg') }}" alt="Twin Home (Gemini)" class="{{ (strpos($questionsAndAnswers->{'dwelling-types'}, 'Twin Home (Gemini)') !== false) ? 'selected' : '' }}"/>
                                        <h3>Twin Home (Gemini)</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <div class="btn btn-lightbrown prev">Previous</div>
                                    <div class="btn btn-custom next">Next</div>
                                    <div class="btn btn-custom-o review">Finish</div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <input type="submit" name="save-again" class="btn btn-bluegrey save" value="Save as Draft">
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif



                    @if ($fixedQuestions[6]->active == 1)
                    <section id="zipcode" class='{{ (($savedDraft->left_at == "zipcode") ? 'active' : '') }}'>
                        <div class="container">
                            <div class="text-center mb40">
                                {!! Application::moreThoughtsToolTip(
                                    array(
                                        'ct' => $ct,
                                        'tag' => $fixedQuestions[6]->tag,
                                        'question' => $fixedQuestions[6]->question,
                                        'pros' => $fixedQuestions[6]->pros,
                                        'cons' => $fixedQuestions[6]->cons,
                                        'life-hacks' => $fixedQuestions[6]->life_hacks
                                    ))
                                !!}
                            </div>

                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[6]->question }}</h2>
                            <div class="row">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <input type="text" name="zipcode" class="form-control" value="{{ $questionsAndAnswers->{'zipcode'} }}" placeholder="Ex. 12345,54321,13524"/>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <div class="btn btn-lightbrown prev">Previous</div>
                                    <div class="btn btn-custom next">Next</div>
                                    <div class="btn btn-custom-o review">Finish</div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <input type="submit" name="save-again" class="btn btn-bluegrey save" value="Save as Draft">
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif



                    @if ($fixedQuestions[13]->active == 1)
                    <section id="garage-spaces" class='{{ (($savedDraft->left_at == "garage-spaces") ? 'active' : '') }}'>
                        <div class="container">
                            <div class="text-center mb40">
                                {!! Application::moreThoughtsToolTip(
                                    array(
                                        'ct' => $ct,
                                        'tag' => $fixedQuestions[13]->tag,
                                        'question' => $fixedQuestions[13]->question,
                                        'pros' => $fixedQuestions[13]->pros,
                                        'cons' => $fixedQuestions[13]->cons,
                                        'life-hacks' => $fixedQuestions[13]->life_hacks
                                    ))
                                !!}
                            </div>

                            <input type="hidden" name="garage-spaces" value="{{ $questionsAndAnswers->{'garage-spaces'} }}" />
                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[13]->question }}</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="square-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/garage-space/garage-space-1.png') }}" alt="1 Car" class="{{ $questionsAndAnswers->{'garage-spaces'} == '1 Car' ? 'selected' : '' }}"/>
                                        <h3>1 Car</h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="square-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/garage-space/garage-space-2.png') }}" alt="2 Cars" class="{{ $questionsAndAnswers->{'garage-spaces'} == '2 Cars' ? 'selected' : '' }}"/>
                                        <h3>2 Cars</h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="square-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/garage-space/garage-space-3.png') }}" alt="3 Cars" class="{{ $questionsAndAnswers->{'garage-spaces'} == '3 Cars' ? 'selected' : '' }}"/>
                                        <h3>3 Cars</h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="square-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/garage-space/garage-space-4.png') }}" alt="4+ Cars" class="{{ $questionsAndAnswers->{'garage-spaces'} == '4+ Cars' ? 'selected' : '' }}"/>
                                        <h3>4+ Cars</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <div class="btn btn-lightbrown prev">Previous</div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <input type="submit" name="save-again" class="btn btn-bluegrey save" value="Save as Draft">
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[14]->active == 1)
                    <section id="specific-subdivision" class='{{ (($savedDraft->left_at == "specific-subdivision") ? 'active' : '') }}'>
                        <div class="container">
                            <div class="text-center mb40">
                                {!! Application::moreThoughtsToolTip(
                                    array(
                                        'ct' => $ct,
                                        'tag' => $fixedQuestions[14]->tag,
                                        'question' => $fixedQuestions[14]->question,
                                        'pros' => $fixedQuestions[14]->pros,
                                        'cons' => $fixedQuestions[14]->cons,
                                        'life-hacks' => $fixedQuestions[14]->life_hacks
                                    ))
                                !!}
                            </div>

                            <?php
                                $specificSubDivision = array('yes-no' => '', 'ss' => '');

                                // If not blank
                                if ($questionsAndAnswers->{'specific-subdivision'} != '') {
                                    // If YES
                                    if (strpos($questionsAndAnswers->{'specific-subdivision'}, '|') !== false) {
                                        $ssdArr = explode(' | ', $questionsAndAnswers->{'specific-subdivision'});

                                        $specificSubDivision['yes-no'] = $ssdArr[0];
                                        $specificSubDivision['ss'] = $ssdArr[1];
                                    }
                                    // If NO
                                    else {
                                        $specificSubDivision['yes-no'] = 'No';
                                    }
                                }
                            ?>

                            <input type="hidden" name="specific-subdivision" value="{{ $questionsAndAnswers->{'specific-subdivision'} }}" />
                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[$ct - 1]->question }}</h2>
                            <div class="row">
                                <div class="col-md-4 col-md-offset-2 col-sm-6">
                                    <div class="bg-circle-o {{ ($specificSubDivision['yes-no'] == 'Yes') ? 'selected' : '' }}">
                                        <div class="circle-text">
                                            Yes
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="bg-circle {{ ($specificSubDivision['yes-no'] == 'No') ? 'selected' : '' }}">
                                        <div class="circle-text">
                                            No
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt30" id="specific-subdivision-row" {{ ($specificSubDivision['yes-no'] == 'Yes') ? 'style="display:block"' : '' }}>
                                <div class="col-sm-6 col-sm-offset-3">
                                    <h4>What subdivision?</h4>
                                    <input type="text" name="specific-subdivision-input" class="form-control" value="{{ $specificSubDivision['ss'] }}"/>
                                    <div class="text-center">
                                        <div class="btn btn-custom next">Next</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <div class="btn btn-lightbrown prev">Previous</div>
                                    <div class="btn btn-custom-o review">Finish</div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <input type="submit" name="save-again" class="btn btn-bluegrey save" value="Save as Draft">
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[15]->active == 1)
                    <section id="architecture-type" class=''>
                        <div class="container">
                            <div class="text-center mb40">
                                {!! Application::moreThoughtsToolTip(
                                    array(
                                        'ct' => $ct,
                                        'tag' => $fixedQuestions[15]->tag,
                                        'question' => $fixedQuestions[15]->question,
                                        'pros' => $fixedQuestions[15]->pros,
                                        'cons' => $fixedQuestions[15]->cons,
                                        'life-hacks' => $fixedQuestions[15]->life_hacks
                                    ))
                                !!}
                            </div>

                            <?php

                                $other = false;
                                if ($questionsAndAnswers->{'architecture-type'} != 'Farmhouse'
                                    && $questionsAndAnswers->{'architecture-type'} != 'Contemporary'
                                    && $questionsAndAnswers->{'architecture-type'} != 'Adobe Revival'
                                    && $questionsAndAnswers->{'architecture-type'} != 'French Country'
                                    && $questionsAndAnswers->{'architecture-type'} != 'Tuscan Homes'
                                    && $questionsAndAnswers->{'architecture-type'} != 'Spanish Homes'
                                ) {
                                    $other = true;
                                }

                            ?>

                            <input type="hidden" name="architecture-type" value="{{ $questionsAndAnswers->{'architecture-type'} }}" />
                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[15]->question }}</h2>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/architecture-type/farmhouse.jpg') }}" alt="Farmhouse" class="{{ $questionsAndAnswers->{'architecture-type'} == 'Farmhouse' ? 'selected' : '' }}"/>
                                        <h3>Farmhouse</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/architecture-type/contemporary.jpg') }}" alt="Contemporary" class="{{ $questionsAndAnswers->{'architecture-type'} == 'Contemporary' ? 'selected' : '' }}"/>
                                        <h3>Contemporary</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/architecture-type/adobe-revival.jpg') }}" alt="Adobe Revival" class="{{ $questionsAndAnswers->{'architecture-type'} == 'Adobe Revival' ? 'selected' : '' }}"/>
                                        <h3>Adobe Revival</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/architecture-type/french-country.jpg') }}" alt="French Country" class="{{ $questionsAndAnswers->{'architecture-type'} == 'French Country' ? 'selected' : '' }}"/>
                                        <h3>French Country</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/architecture-type/tuscan.jpg') }}" alt="Tuscan Homes" class="{{ $questionsAndAnswers->{'architecture-type'} == 'Tuscan Homes' ? 'selected' : '' }}"/>
                                        <h3>Tuscan Homes</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/architecture-type/spanish.jpg') }}" alt="Spanish Homes" class="{{ $questionsAndAnswers->{'architecture-type'} == 'Spanish Homes' ? 'selected' : '' }}"/>
                                        <h3>Spanish Homes</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt30">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <h4>Other</h4>
                                    <input type="text" name="architecture-type-input" class="form-control" value="{{ ($other) ? $questionsAndAnswers->{'architecture-type'} : '' }}"/>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="btn btn-lightbrown prev">Previous</div>
                                    <div class="btn btn-custom next">Next</div>
                                    <div class="btn btn-custom-o review">Finish</div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <input type="submit" name="save-again" class="btn btn-bluegrey save" value="Save as Draft">
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @foreach ($questions as $question)
                    <section id="{{ $question->tag }}" class="{{ $question->image != '' ? 'has-image' : '' }} {{ $question->tag == $savedDraft->left_at ? 'active' : '' }}">
                        <div class="container">
                            <input type="hidden" name="question_id" value="{{ $question->id }}" />
                            <input type="hidden" name="questions_to_skip_ids" value="{{ $question->questions_to_skip_ids }}" />
                            <input type="hidden" name="{{ $question->tag }}" value="{{ array_key_exists($question->tag, $questionsAndAnswers) ? $questionsAndAnswers->{$question->tag} : '' }}" />
                            @if ($question->image != '')
                                <div class="app-img">
                                    <img src="{{ asset('/images/homedreambuilder/application/other-features/' . $question->image) }}" alt="{{ $question->question }}" />
                                </div>
                            @endif
                            <div class="text-center mb30">
                                {!! Application::moreThoughtsToolTip(
                                    array(
                                        'ct' => $ct,
                                        'tag' => $question->tag,
                                        'question' => $question->question,
                                        'pros' => $question->pros,
                                        'cons' => $question->cons,
                                        'life-hacks' => $question->life_hacks
                                    ))
                                !!}
                            </div>
                            <h2>{{ $questionNum++ }}. <span class="question-title">{{ $question->question }}</span></h2>
                            <div class="row">
                                <div class="col-md-4 col-md-offset-2 col-sm-6">
                                    <div class="property-img yes-no {{ array_key_exists($question->tag, $questionsAndAnswers) && $questionsAndAnswers->{$question->tag} == 'Yes' ? 'clicked' : ''  }}">
                                        <img src="{{ asset('/images/homedreambuilder/application/placeholder/yes.png') }}" alt="{{ $question->question }} - Yes"/>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="property-img yes-no {{ array_key_exists($question->tag, $questionsAndAnswers) && $questionsAndAnswers->{$question->tag} == 'No' ? 'clicked' : ''  }}">
                                        <img src="{{ asset('/images/homedreambuilder/application/placeholder/no.png') }}" alt="{{ $question->question }} - No"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt30">
                                <div class="col-md-12 text-center">
                                    <div class="btn btn-lightbrown prev">Previous</div>
                                </div>
                            </div>
                            <div class="row mt30 mb60">
                                <div class="col-md-12 text-center">
                                    <input type="submit" name="save-again" class="btn btn-bluegrey save" value="Save as Draft">
                                </div>
                            </div>
                        </div>
                    </section>
                    @endforeach

                    @if ($fixedQuestions[0]->active == 1)
                    <section id="asking-price" class='{{ (($savedDraft->left_at == "asking-price") ? 'active' : '') }}'>
                        <div class="container">
                            <div class="text-center mb40">
                                {!! Application::moreThoughtsToolTip(
                                    array(
                                        'ct' => $ct,
                                        'tag' => $fixedQuestions[0]->tag,
                                        'question' => $fixedQuestions[0]->question,
                                        'pros' => $fixedQuestions[0]->pros,
                                        'cons' => $fixedQuestions[0]->cons,
                                        'life-hacks' => $fixedQuestions[0]->life_hacks
                                    ))
                                !!}
                            </div>

                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[0]->question }}</h2>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="slider-value"><span>{{ $questionsAndAnswers->{'asking-price'} }}</span></div>
                                    <div class="slider-container">
                                        <span class="minmax-value">$80,000</span>
                                        <input type="hidden" name="asking-price" value="{{ $questionsAndAnswers->{'asking-price'} }}"/>
                                        <input type="text"
                                               name="asking-price-slider"
                                               class="slider slider-horizontal"
                                               id="asking-price-slider"
                                               data-ui-slider=""
                                               data-slider-min="0"
                                               data-slider-max="29"
                                               data-slider-value="0"
                                               data-slider-tooltip="disable">
                                        <span class="minmax-value">$1,000,000+</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <div class="btn btn-lightbrown prev">Previous</div>
                                    <div class="btn btn-custom next">Next</div>
                                    <div class="btn btn-custom-o review">Finish</div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <input type="submit" name="save-again" class="btn btn-bluegrey save" value="Save as Draft">
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[1]->active == 1)
                    <section id="monthly-payment" class='{{ (($savedDraft->left_at == "monthly-payment") ? 'active' : '') }}'>
                            <div class="container">
                                <div class="text-center mb40">
                                    {!! Application::moreThoughtsToolTip(
                                        array(
                                            'ct' => $ct,
                                            'tag' => $fixedQuestions[1]->tag,
                                            'question' => $fixedQuestions[1]->question,
                                            'pros' => $fixedQuestions[1]->pros,
                                            'cons' => $fixedQuestions[1]->cons,
                                            'life-hacks' => $fixedQuestions[1]->life_hacks
                                        ))
                                    !!}
                                </div>

                                <h2>{{ $questionNum++ }}. {{ $fixedQuestions[1]->question }}</h2>
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="slider-value"><span>{{ $questionsAndAnswers->{'monthly-payment'} }}</span></div>
                                        <div class="slider-container">
                                            <span class="minmax-value">$500</span>
                                            <input type="hidden" name="monthly-payment" value="{{ $questionsAndAnswers->{'monthly-payment'} }}"/>
                                            <input type="text"
                                                   name="monthly-payment-slider"
                                                   class="slider slider-horizontal"
                                                   id="monthly-payment-slider"
                                                   data-ui-slider=""
                                                   data-slider-min="0"
                                                   data-slider-max="24"
                                                   data-slider-value="0"
                                                   data-slider-tooltip="disable">
                                            <span class="minmax-value">$5,000+</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt60">
                                    <div class="col-md-12 text-center">
                                        <div class="btn btn-lightbrown prev">Previous</div>
                                        <div class="btn btn-custom next">Next</div>
                                        <div class="btn btn-custom-o review">Finish</div>
                                    </div>
                                </div>
                                <div class="row mt60">
                                    <div class="col-md-12 text-center">
                                        <input type="submit" name="save-again" class="btn btn-bluegrey save" value="Save as Draft">
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif

                    @if ($fixedQuestions[4]->active == 1)
                    <section id="dwelling-styles" class='{{ (($savedDraft->left_at == "dwelling-styles") ? 'active' : '') }}'>
                    <div class="container">
                        <div class="text-center mb40">
                            {!! Application::moreThoughtsToolTip(
                                array(
                                    'ct' => $ct,
                                    'tag' => $fixedQuestions[4]->tag,
                                    'question' => $fixedQuestions[4]->question,
                                    'pros' => $fixedQuestions[4]->pros,
                                    'cons' => $fixedQuestions[4]->cons,
                                    'life-hacks' => $fixedQuestions[4]->life_hacks
                                ))
                            !!}
                        </div>

                        <div class="text-center ft-700 mb30">* You can select multiple dwelling styles</div>
                        <input type="hidden" name="dwelling-styles" value="{{ $questionsAndAnswers->{'dwelling-styles'} }}" />
                        <h2>{{ $questionNum++ }}. Dwelling Style</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkbox-btns">
                                    <div class="checkbox-btn">
                                        <input type="checkbox" name="dwelling-style" value="Detached" {{ (strpos($questionsAndAnswers->{'dwelling-styles'}, 'Detached') !== false) ? 'checked="checked"' : '' }} /> <span>Detached</span>
                                    </div>
                                    <div class="checkbox-btn">
                                        <input type="checkbox" name="dwelling-style" value="Attached" {{ (strpos($questionsAndAnswers->{'dwelling-styles'}, 'Attached') !== false) ? 'checked="checked"' : '' }} /> <span>Attached</span>
                                    </div>
                                    <div class="checkbox-btn">
                                        <input type="checkbox" name="dwelling-style" value="Stacked" {{ (strpos($questionsAndAnswers->{'dwelling-styles'}, 'Stacked') !== false) ? 'checked="checked"' : '' }} /> <span>Stacked</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt60">
                            <div class="col-md-12 text-center">
                                <div class="btn btn-lightbrown prev">Previous</div>
                                <div class="btn btn-custom next">Next</div>
                                <div class="btn btn-custom-o review">Finish</div>
                            </div>
                        </div>
                        <div class="row mt60">
                            <div class="col-md-12 text-center">
                                <input type="submit" name="save-again" class="btn btn-bluegrey save" value="Save as Draft">
                            </div>
                        </div>
                    </div>
                </section>
                    @endif

                    @if ($fixedQuestions[5]->active == 1)
                    <section id="city" class='{{ (($savedDraft->left_at == "city") ? 'active' : '') }}'>
                        <div class="container">
                            <div class="text-center mb40">
                                {!! Application::moreThoughtsToolTip(
                                    array(
                                        'ct' => $ct,
                                        'tag' => $fixedQuestions[5]->tag,
                                        'question' => $fixedQuestions[5]->question,
                                        'pros' => $fixedQuestions[5]->pros,
                                        'cons' => $fixedQuestions[5]->cons,
                                        'life-hacks' => $fixedQuestions[5]->life_hacks
                                    ))
                                !!}
                            </div>

                            <input type="hidden" name="city" value="{{ $questionsAndAnswers->{'city'} }}" />
                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[5]->question }}</h2>
                            <div class="row">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <?php $cities = explode(' and ', $questionsAndAnswers->{'city'}); ?>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="black">1st Choice</label>
                                            <input type="text" name="city-1" class="form-control" value="{{ $cities[0] }}" placeholder="City #1"/>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="black">2nd Choice</label>
                                            <input type="text" name="city-2" class="form-control" value="{{ (count($cities) > 1) ? $cities[1] : '' }}" placeholder="City #2"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <div class="btn btn-lightbrown prev">Previous</div>
                                    <div class="btn btn-custom next">Next</div>
                                    <div class="btn btn-custom-o review">Finish</div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <input type="submit" name="save-again" class="btn btn-bluegrey save" value="Save as Draft">
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[7]->active == 1)
                    <section id="num-of-bedrooms" class='{{ (($savedDraft->left_at == "num-of-bedrooms") ? 'active' : '') }}'>
                        <div class="container">
                            <div class="text-center mb40">
                                {!! Application::moreThoughtsToolTip(
                                    array(
                                        'ct' => $ct,
                                        'tag' => $fixedQuestions[7]->tag,
                                        'question' => $fixedQuestions[7]->question,
                                        'pros' => $fixedQuestions[7]->pros,
                                        'cons' => $fixedQuestions[7]->cons,
                                        'life-hacks' => $fixedQuestions[7]->life_hacks
                                    ))
                                !!}
                            </div>

                            <input type="hidden" name="num-of-bedrooms" value="{{ $questionsAndAnswers->{'num-of-bedrooms'} }}" />
                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[7]->question }}</h2>
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle">
                                        <div class="circle-text {{ ($questionsAndAnswers->{'num-of-bedrooms'} == '2 or Less Bedrooms') ? 'selected' : '' }}">
                                            2 or Less Bedrooms
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle {{ ($questionsAndAnswers->{'num-of-bedrooms'} == '3 Bedrooms') ? 'selected' : '' }}">
                                        <div class="circle-text">
                                            3 Bedrooms
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle {{ ($questionsAndAnswers->{'num-of-bedrooms'} == '4 Bedrooms') ? 'selected' : '' }}">
                                        <div class="circle-text">
                                            4 Bedrooms
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle {{ ($questionsAndAnswers->{'num-of-bedrooms'} == '5+ Bedrooms') ? 'selected' : '' }}">
                                        <div class="circle-text">
                                            5+ Bedrooms
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt30">
                                <div class="col-md-12 text-center">
                                    <div class="btn btn-lightbrown prev">Previous</div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <input type="submit" name="save-again" class="btn btn-bluegrey save" value="Save as Draft">
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[8]->active == 1)
                    <section id="num-of-bathrooms" class='{{ (($savedDraft->left_at == "num-of-bathrooms") ? 'active' : '') }}'>
                        <div class="container">
                            <div class="text-center mb40">
                                {!! Application::moreThoughtsToolTip(
                                    array(
                                        'ct' => $ct,
                                        'tag' => $fixedQuestions[8]->tag,
                                        'question' => $fixedQuestions[8]->question,
                                        'pros' => $fixedQuestions[8]->pros,
                                        'cons' => $fixedQuestions[8]->cons,
                                        'life-hacks' => $fixedQuestions[8]->life_hacks
                                    ))
                                !!}
                            </div>

                            <input type="hidden" name="num-of-bathrooms" value="{{ $questionsAndAnswers->{'num-of-bathrooms'} }}" />
                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[8]->question }}</h2>
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o {{ ($questionsAndAnswers->{'num-of-bathrooms'} == '1 Bathroom') ? 'selected' : '' }}">
                                        <div class="circle-text">
                                            1 Bathroom
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o {{ ($questionsAndAnswers->{'num-of-bathrooms'} == ' Bathrooms') ? 'selected' : '' }}">
                                        <div class="circle-text">
                                            2 Bathrooms
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o {{ ($questionsAndAnswers->{'num-of-bathrooms'} == '3 Bathrooms') ? 'selected' : '' }}">
                                        <div class="circle-text">
                                            3 Bathrooms
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o {{ ($questionsAndAnswers->{'num-of-bathrooms'} == '4+ Bathrooms') ? 'selected' : '' }}">
                                        <div class="circle-text">
                                            4+ Bathrooms
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt30">
                                <div class="col-md-12 text-center">
                                    <div class="btn btn-lightbrown prev">Previous</div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <input type="submit" name="save-again" class="btn btn-bluegrey save" value="Save as Draft">
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[9]->active == 1)
                    <section id="approx-sq-ft-home" class='{{ (($savedDraft->left_at == "approx-sq-ft-home") ? 'active' : '') }}'>
                        <div class="container">
                            <div class="text-center mb40">
                                {!! Application::moreThoughtsToolTip(
                                    array(
                                        'ct' => $ct,
                                        'tag' => $fixedQuestions[9]->tag,
                                        'question' => $fixedQuestions[9]->question,
                                        'pros' => $fixedQuestions[9]->pros,
                                        'cons' => $fixedQuestions[9]->cons,
                                        'life-hacks' => $fixedQuestions[9]->life_hacks
                                    ))
                                !!}
                            </div>

                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[9]->question }}</h2>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="slider-value"><span>{{ $questionsAndAnswers->{'approx-sq-ft-home'} }}</span></div>
                                    <div class="slider-container">
                                        <span class="minmax-value">500</span>
                                        <input type="hidden" name="approx-sq-ft-home" value="{{ $questionsAndAnswers->{'approx-sq-ft-home'} }}"/>
                                        <input type="text"
                                               name="approx-sq-ft-home-slider"
                                               class="slider slider-horizontal"
                                               id="approx-sq-ft-home-slider"
                                               data-ui-slider=""
                                               data-slider-min="0"
                                               data-slider-max="22"
                                               data-slider-value="0"
                                               data-slider-tooltip="disable">
                                        <span class="minmax-value">6,000+</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <div class="btn btn-lightbrown prev">Previous</div>
                                    <div class="btn btn-custom next">Next</div>
                                    <div class="btn btn-custom-o review">Finish</div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <input type="submit" name="save-again" class="btn btn-bluegrey save" value="Save as Draft">
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[10]->active == 1)
                    <section id="lot-size-slide" class='{{ (($savedDraft->left_at == "lot-size-slide") ? 'active' : '') }}'>
                        <div class="container">
                            <div class="text-center mb40">
                                {!! Application::moreThoughtsToolTip(
                                    array(
                                        'ct' => $ct,
                                        'tag' => $fixedQuestions[10]->tag,
                                        'question' => $fixedQuestions[10]->question,
                                        'pros' => $fixedQuestions[10]->pros,
                                        'cons' => $fixedQuestions[10]->cons,
                                        'life-hacks' => $fixedQuestions[10]->life_hacks
                                    ))
                                !!}
                            </div>

                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[10]->question }}</h2>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="slider-value"><span>{{ $questionsAndAnswers->{'lot-size-slide'} }}</span></div>
                                    <div class="slider-container">
                                        <span class="minmax-value">7,000</span>
                                        <input type="hidden" name="lot-size-slide" value="{{ $questionsAndAnswers->{'lot-size-slide'} }}"/>
                                        <input type="text"
                                               name="lot-size-slide-slider"
                                               class="slider slider-horizontal"
                                               id="lot-size-slide-slider"
                                               data-ui-slider=""
                                               data-slider-min="0"
                                               data-slider-max="26"
                                               data-slider-value="0"
                                               data-slider-tooltip="disable">
                                        <span class="minmax-value">135,000+</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <div class="btn btn-lightbrown prev">Previous</div>
                                    <div class="btn btn-custom next">Next</div>
                                    <div class="btn btn-custom-o review">Finish</div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <input type="submit" name="save-again" class="btn btn-bluegrey save" value="Save as Draft">
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[11]->active == 1)
                    <section id="num-of-interior-levels" class='{{ (($savedDraft->left_at == "num-of-interior-levels") ? 'active' : '') }}'>
                        <div class="container">
                            <div class="text-center mb40">
                                {!! Application::moreThoughtsToolTip(
                                    array(
                                        'ct' => $ct,
                                        'tag' => $fixedQuestions[11]->tag,
                                        'question' => $fixedQuestions[11]->question,
                                        'pros' => $fixedQuestions[11]->pros,
                                        'cons' => $fixedQuestions[11]->cons,
                                        'life-hacks' => $fixedQuestions[11]->life_hacks
                                    ))
                                !!}
                            </div>

                            <input type="hidden" name="num-of-interior-levels" value="{{ $questionsAndAnswers->{'num-of-interior-levels'} }}" />
                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[11]->question }}</h2>
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o {{ ($questionsAndAnswers->{'num-of-interior-levels'} == '1 Story') ? 'selected' : '' }}">
                                        <div class="circle-text">
                                            1 Story
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o {{ ($questionsAndAnswers->{'num-of-interior-levels'} == '2 Story') ? 'selected' : '' }}">
                                        <div class="circle-text">
                                            2 Story
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o {{ ($questionsAndAnswers->{'num-of-interior-levels'} == '3 Story') ? 'selected' : '' }}">
                                        <div class="circle-text">
                                            3 Story
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o {{ ($questionsAndAnswers->{'num-of-interior-levels'} == '4+ Story') ? 'selected' : '' }}">
                                        <div class="circle-text">
                                            4+ Story
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt30">
                                <div class="col-md-12 text-center">
                                    <div class="btn btn-lightbrown prev">Previous</div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <input type="submit" name="save-again" class="btn btn-bluegrey save" value="Save as Draft">
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[12]->active == 1)
                    <section id="year-built" class='{{ (($savedDraft->left_at == "year-built") ? 'active' : '') }}'>
                        <div class="container">
                            <div class="text-center mb40">
                                {!! Application::moreThoughtsToolTip(
                                    array(
                                        'ct' => $ct,
                                        'tag' => $fixedQuestions[12]->tag,
                                        'question' => $fixedQuestions[12]->question,
                                        'pros' => $fixedQuestions[12]->pros,
                                        'cons' => $fixedQuestions[12]->cons,
                                        'life-hacks' => $fixedQuestions[12]->life_hacks
                                    ))
                                !!}
                            </div>

                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[12]->question }}</h2>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="slider-value"><span>{{ $questionsAndAnswers->{'year-built'} }}</span></div>
                                    <div class="slider-container">
                                        <span class="minmax-value">1900</span>
                                        <input type="hidden" name="year-built" value="{{ $questionsAndAnswers->{'year-built'} }}"/>
                                        <input type="text"
                                               name="year-built-slider"
                                               class="slider slider-horizontal"
                                               id="year-built-slider"
                                               data-ui-slider=""
                                               data-slider-min="0"
                                               data-slider-max="12"
                                               data-slider-value="0"
                                               data-slider-tooltip="disable">
                                        <span class="minmax-value">2020+</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <div class="btn btn-lightbrown prev">Previous</div>
                                    <div class="btn btn-custom next">Next</div>
                                    <div class="btn btn-custom-o review">Finish</div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <input type="submit" name="save-again" class="btn btn-bluegrey save" value="Save as Draft">
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    <section id="review" class="{{ (($savedDraft->left_at == "review") ? 'active' : '') }}">
                        <div class="container">
                            <h2>Review</h2>
                            <div class="text-center">
                                <p class="mb5"><b>Congratulations!</b></p>
                                <p class="mb5">You are starting to gain clarity on your next home.</p>
                                <p class="mb5">The next important step is to narrow your list down to you <b>MOST IMPORTANT</b> 10 Choices about your next home.</p>
                                <p class="mb5">These are the the most important aspects of your next home.</p>
                                <p class="mb5">As you click on the choices they will add to your top 10 list on the right side.</p>
                            </div>
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="table-container" id='form-table-container'>
                                        <table class="table-bordered" id='form-table'>
                                            <thead>
                                            <tr>
{{--                                                <th style='width:10%'></th>--}}
                                                <th style="width:35%">Questions</th>
                                                <th style="width:45%">Value</th>
                                                <th style="width:10%">Select</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $ct = 0; ?>
                                            @if ($fixedQuestions[2]->active == 1)
                                                <?php $ct++; ?>
                                                {!! Application::formTableValue($ct, $fixedQuestions[2]->tag, $fixedQuestions[2]->question, (array_key_exists($fixedQuestions[2]->tag, $questionsAndAnswers)) ? $questionsAndAnswers->{$fixedQuestions[2]->tag} : '', $top10FeaturesTag, !array_key_exists($fixedQuestions[2]->tag, $questionsAndAnswers)) !!}
                                            @endif
                                            @if ($fixedQuestions[3]->active == 1)
                                                <?php $ct++; ?>
                                                {!! Application::formTableValue($ct, $fixedQuestions[3]->tag, $fixedQuestions[3]->question, (array_key_exists($fixedQuestions[3]->tag, $questionsAndAnswers)) ? $questionsAndAnswers->{$fixedQuestions[3]->tag} : '', $top10FeaturesTag, !array_key_exists($fixedQuestions[3]->tag, $questionsAndAnswers)) !!}
                                            @endif
                                            @if ($fixedQuestions[6]->active == 1)
                                                <?php $ct++; ?>
                                                {!! Application::formTableValue($ct, $fixedQuestions[6]->tag, $fixedQuestions[6]->question, (array_key_exists($fixedQuestions[6]->tag, $questionsAndAnswers)) ? $questionsAndAnswers->{$fixedQuestions[6]->tag} : '', $top10FeaturesTag, !array_key_exists($fixedQuestions[6]->tag, $questionsAndAnswers)) !!}
                                            @endif
                                            @for ($i = 13; $i <= 15; $i++)
                                                @if ($fixedQuestions[$i]->active == 1)
                                                    <?php $ct++; ?>
                                                    {!! Application::formTableValue($ct, $fixedQuestions[$i]->tag, $fixedQuestions[$i]->question, (array_key_exists($fixedQuestions[$i]->tag, $questionsAndAnswers)) ? $questionsAndAnswers->{$fixedQuestions[$i]->tag} : '', $top10FeaturesTag, !array_key_exists($fixedQuestions[$i]->tag, $questionsAndAnswers)) !!}
                                                @endif
                                            @endfor
                                            @foreach ($questions as $question)
                                                <?php $ct++; ?>
                                                {!! Application::formTableValue($ct, $question->tag, $question->question, (array_key_exists($question->tag, $questionsAndAnswers)) ? $questionsAndAnswers->{$question->tag} : '', $top10FeaturesTag, !array_key_exists($question->tag, $questionsAndAnswers)) !!}
                                            @endforeach
                                            @if ($fixedQuestions[0]->active == 1)
                                                <?php $ct++; ?>
                                                {!! Application::formTableValue($ct, $fixedQuestions[0]->tag, $fixedQuestions[0]->question, (array_key_exists($fixedQuestions[0]->tag, $questionsAndAnswers)) ? $questionsAndAnswers->{$fixedQuestions[0]->tag} : '', $top10FeaturesTag, !array_key_exists($fixedQuestions[0]->tag, $questionsAndAnswers)) !!}
                                            @endif
                                            @if ($fixedQuestions[1]->active == 1)
                                                <?php $ct++; ?>
                                                {!! Application::formTableValue($ct, $fixedQuestions[1]->tag, $fixedQuestions[1]->question, (array_key_exists($fixedQuestions[1]->tag, $questionsAndAnswers)) ? $questionsAndAnswers->{$fixedQuestions[1]->tag} : '', $top10FeaturesTag, !array_key_exists($fixedQuestions[1]->tag, $questionsAndAnswers)) !!}
                                            @endif
                                            @if ($fixedQuestions[4]->active == 1)
                                                <?php $ct++; ?>
                                                {!! Application::formTableValue($ct, $fixedQuestions[4]->tag, $fixedQuestions[4]->question, (array_key_exists($fixedQuestions[4]->tag, $questionsAndAnswers)) ? $questionsAndAnswers->{$fixedQuestions[4]->tag} : '', $top10FeaturesTag, !array_key_exists($fixedQuestions[4]->tag, $questionsAndAnswers)) !!}
                                            @endif
                                            @if ($fixedQuestions[5]->active == 1)
                                                <?php $ct++; ?>
                                                {!! Application::formTableValue($ct, $fixedQuestions[5]->tag, $fixedQuestions[5]->question, (array_key_exists($fixedQuestions[5]->tag, $questionsAndAnswers)) ? $questionsAndAnswers->{$fixedQuestions[5]->tag} : '', $top10FeaturesTag, !array_key_exists($fixedQuestions[5]->tag, $questionsAndAnswers)) !!}
                                            @endif
                                            @for ($i = 7; $i <= 12; $i++)
                                                @if ($fixedQuestions[$i]->active == 1)
                                                    <?php $ct++; ?>
                                                    {!! Application::formTableValue($ct, $fixedQuestions[$i]->tag, $fixedQuestions[$i]->question, (array_key_exists($fixedQuestions[$i]->tag, $questionsAndAnswers)) ? $questionsAndAnswers->{$fixedQuestions[$i]->tag} : '', $top10FeaturesTag, !array_key_exists($fixedQuestions[$i]->tag, $questionsAndAnswers)) !!}
                                                @endif
                                            @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="table-container" id='top-10-table-container'>
                                        <table class="table-bordered" id='top-10-table'>
                                            <thead>
                                            <tr>
                                                <th colspan="2" style="text-align: center">Top 10</th>
                                            </tr>
                                            <tr>
                                                <th style='width:10%'></th>
                                                <th style="width:90%">Features</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @for ($i = 10; $i > 0; $i--)
                                            <tr>
                                                <td>{{ $i }})</td>
                                                <td class="selected-feature" data-value="{{ ((10 - $i < count($top10FeaturesTag)) ? $top10FeaturesTag[10 - $i] : '') }}" id="feature-{{ $i }}">{{ ((10 - $i < count($top10Features)) ? $top10Features[10 - $i] : '') }}</td>
                                            </tr>
                                            @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt30">
                                <div class="col-sm-6 col-lg-4 text-left text-center-xs mb20">
                                    <input type="submit" name="save-again" class="btn btn-bluegrey save" value="Save as Draft">
                                </div>
                                <div class="col-sm-6 col-lg-4 col-lg-offset-1 text-right text-center-xs mb20">
                                    <div class="btn btn-custom-o next">Please email me my list</div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="final-section" class="{{ (($savedDraft->left_at == "final-section") ? 'active' : '') }}">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <h2>Fill out your information to finish</h2>
                                    <p>Fill out your information below and we will email you your home dream builder list and then get back to you.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="input-desc">First Name</label>
                                        <input type="text" name="firstname" class="form-control" value="{{ $user->firstname }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="input-desc">Last Name</label>
                                        <input type="text" name="lastname" class="form-control" value="{{ $user->lastname }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="input-desc">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-12'>
                                    <div class="form-group">
                                        <input type="checkbox" name="pre-approved-information" value="1" {{ ($application->pre_approved_information == 1) ? 'checked' : '' }}>
                                        <label>I would also like information on getting pre-approved for a home loan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt30">
                                <div class='col-sm-12'>
                                    <p class="ft-500">
                                        If you would like to schedule a call with a home financing specialist, please type in
                                        your phone number and we will get back to you by the next business day.
                                    </p>
                                    <label class="input-desc">Phone Number</label>
                                    <?php $phone = explode('-', $application->phone) ?>
                                    <div id='phone'>
                                        <div class="phone-number">
                                            <input type="text" name="first-num" class="form-control" maxlength='3' value="{{ (count($phone) > 1) ? $phone[0] : '' }}"/>
                                        </div>
                                        <span>&ndash;</span>
                                        <div class="phone-number">
                                            <input type="text" name="second-num" class="form-control" maxlength='3' value="{{ (count($phone) > 1) ? $phone[1] : '' }}"/>
                                        </div>
                                        <span>&ndash;</span>
                                        <div class="phone-number">
                                            <input type="text" name="third-num" class="form-control" maxlength='4' value="{{ (count($phone) > 1) ? $phone[2] : '' }}"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="no-schedule-call" value="1" {{ ($application->no_schedule_call == 1) ? 'checked' : '' }}>
                                        <label>No thanks, just send me the email for now.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="col-md-6 text-left">
                                        <div class="btn btn-lightbrown prev">Go back</div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <input type="submit" name="finish" class="btn btn-custom submit" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    {{ Form::close() }}
                    @endif


                </div>
            </div>
        </div>
    </section>

@stop

@section('footer')
    @include('footer')
@stop
