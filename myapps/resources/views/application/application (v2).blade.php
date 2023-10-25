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

    <section id="application" class="app-bg-img">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {{ Form::open(['url' => 'confirmation', 'name' => 'ready-to-dream-form', 'class' => 'rtd-form']) }}
                    <input type='hidden' name='form-id' value='0' />
                    <input type='hidden' name='status' value='new' />
                    <input type='hidden' name='left-at' value='' />

                    <?php $firstActive = false; ?>
                    <?php $ct = 2; ?>
                    <?php $questionNum = 1; ?>

                    @if ($fixedQuestions[2]->active == 1)
                    <section id="current-amount" class='<?php echo ((!$firstActive) ? 'active' : ''); $firstActive = true; ?>'>
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
                                    <div class="slider-value"><span>$0</span></div>
                                    <div class="slider-container">
                                        <span class="minmax-value">$0</span>
                                        <input type="hidden" name="current-amount" value="0"/>
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
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[3]->active == 1)
                    <section id="dwelling-types" class='multiple-choices <?php echo ((!$firstActive) ? 'active' : ''); $firstActive = true; ?>'>
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

                            <input type="hidden" name="dwelling-types" value="" />
                            <div class="text-center ft-700">* You can select multiple dwelling types</div>
                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[3]->question }}</h2>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/dwelling-type/single-family.jpg') }}" alt="Single Family"/>
                                        <h3>Single Family</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/dwelling-type/patio.jpg') }}" alt="Patio Home"/>
                                        <h3>Patio Home</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/dwelling-type/townhome.jpg') }}" alt="Townhome"/>
                                        <h3>Townhome</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/dwelling-type/condo.jpg') }}" alt="Condo"/>
                                        <h3>Condo</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/dwelling-type/manufactured-home.jpg') }}" alt="Manufactured"/>
                                        <h3>Manufactured</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/dwelling-type/twin-house.jpg') }}" alt="Twin Home (Gemini)"/>
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
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[6]->active == 1)
                    <section id="zipcode" class='<?php echo ((!$firstActive) ? 'active' : ''); $firstActive = true; ?>'>
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
                                    <input type="text" name="zipcode" class="form-control" placeholder="Ex. 12345,54321,13524"/>
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
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[13]->active == 1)
                    <section id="garage-spaces" class='<?php echo ((!$firstActive) ? 'active' : ''); $firstActive = true; ?>'>
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

                            <input type="hidden" name="garage-spaces" value="" />
                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[13]->question }}</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="square-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/garage-space/garage-space-1.png') }}" alt="1 Car"/>
                                        <h3>1 Car</h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="square-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/garage-space/garage-space-2.png') }}" alt="2 Cars"/>
                                        <h3>2 Cars</h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="square-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/garage-space/garage-space-3.png') }}" alt="3 Cars"/>
                                        <h3>3 Cars</h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="square-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/garage-space/garage-space-4.png') }}" alt="4+ Cars"/>
                                        <h3>4+ Cars</h3>
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
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[14]->active == 1)
                    <section id="specific-subdivision" class='<?php echo ((!$firstActive) ? 'active' : ''); $firstActive = true; ?>'>
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

                            <input type="hidden" name="specific-subdivision" value="" />
                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[14]->question }}</h2>
                            <div class="row">
                                <div class="col-md-4 col-md-offset-2 col-sm-6">
                                    <div class="bg-circle-o">
                                        <div class="circle-text">
                                            Yes
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="bg-circle">
                                        <div class="circle-text">
                                            No
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt30" id="specific-subdivision-row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <h4>What subdivision?</h4>
                                    <input type="text" name="specific-subdivision-input" class="form-control"/>
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
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[15]->active == 1)
                    <section id="architecture-type" class='<?php echo ((!$firstActive) ? 'active' : ''); $firstActive = true; ?>'>
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

                            <input type="hidden" name="architecture-type" value="" />
                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[15]->question }}</h2>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/architecture-type/farmhouse.jpg') }}" alt="Farmhouse"/>
                                        <h3>Farmhouse</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/architecture-type/contemporary.jpg') }}" alt="Contemporary"/>
                                        <h3>Contemporary</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/architecture-type/adobe-revival.jpg') }}" alt="Adobe Revival"/>
                                        <h3>Adobe Revival</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/architecture-type/french-country.jpg') }}" alt="French Country"/>
                                        <h3>French Country</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/architecture-type/tuscan.jpg') }}" alt="Tuscan Homes"/>
                                        <h3>Tuscan Homes</h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="property-img">
                                        <img src="{{ asset('/images/homedreambuilder/application/architecture-type/spanish.jpg') }}" alt="Spanish Homes"/>
                                        <h3>Spanish Homes</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt30">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <h4>Other</h4>
                                    <input type="text" name="architecture-type-input" class="form-control"/>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="btn btn-lightbrown prev">Previous</div>
                                    <div class="btn btn-custom next">Next</div>
                                    <div class="btn btn-custom-o review">Finish</div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @foreach ($questions as $question)
                    <section id="{{ $question->tag }}" class="{{ $question->image != '' ? 'has-image' : '' }} <?php echo ((!$firstActive) ? 'active' : ''); $firstActive = true; ?>">
                        <div class="container">
                            <input type="hidden" name="question_id" value="{{ $question->id }}" />
                            <input type="hidden" name="questions_to_skip_ids" value="{{ $question->questions_to_skip_ids }}" />
                            <input type="hidden" name="{{ $question->tag }}" value="" />
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
                            <?php $ct++; ?>
                            <h2>{{ $questionNum++ }}. <span class="question-title">{{ $question->question }}</span></h2>
                            <div class="row">
                                <div class="col-md-4 col-md-offset-2 col-sm-6">
                                    <div class="property-img yes-no">
                                        <img src="{{ asset('/images/homedreambuilder/application/placeholder/yes.png') }}" alt="{{ $question->question }} - Yes"/>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="property-img yes-no">
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
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endforeach

                    @if ($fixedQuestions[0]->active == 1)
                    <section id="asking-price" class="<?php echo ((!$firstActive) ? 'active' : ''); $firstActive = true; ?>">
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
                                    <div class="slider-value"><span>$80,000</span></div>
                                    <div class="slider-container">
                                        <span class="minmax-value">$80,000</span>
                                        <input type="hidden" name="asking-price" value="0"/>
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
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[1]->active == 1)
                    <section id="monthly-payment" class='<?php echo ((!$firstActive) ? 'active' : ''); $firstActive = true; ?>'>
                        <div class="container">
                            <div class="text-center mb40">
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
                            </div>

                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[1]->question }}</h2>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="slider-value"><span>$500</span></div>
                                    <div class="slider-container">
                                        <span class="minmax-value">$500</span>
                                        <input type="hidden" name="monthly-payment" value="0"/>
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
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[4]->active == 1)
                    <section id="dwelling-styles" class='<?php echo ((!$firstActive) ? 'active' : ''); $firstActive = true; ?>'>
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
                            <input type="hidden" name="dwelling-styles" value="" />
                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[4]->question }}</h2>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkbox-btns">
                                        <div class="checkbox-btn">
                                            <input type="checkbox" name="dwelling-style" value="Detached" /> <span>Detached</span>
                                        </div>
                                        <div class="checkbox-btn">
                                            <input type="checkbox" name="dwelling-style" value="Attached" /> <span>Attached</span>
                                        </div>
                                        <div class="checkbox-btn">
                                            <input type="checkbox" name="dwelling-style" value="Stacked" /> <span>Stacked</span>
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
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[5]->active == 1)
                    <section id="city" class='<?php echo ((!$firstActive) ? 'active' : ''); $firstActive = true; ?>'>
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
                            <input type="hidden" name="city" value="" />
                            <h2 class="mb30">{{ $questionNum++ }}. {{ $fixedQuestions[5]->question }}</h2>
                            <div class="row">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="black">1st Choice</label>
                                            <input type="text" name="city-1" class="form-control" placeholder="City #1"/>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="black">2nd Choice</label>
                                            <input type="text" name="city-2" class="form-control" placeholder="City #2"/>
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
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[7]->active == 1)
                    <section id="num-of-bedrooms" class='<?php echo ((!$firstActive) ? 'active' : ''); $firstActive = true; ?>'>
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

                            <input type="hidden" name="num-of-bedrooms" value="" />
                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[7]->question }}</h2>
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle">
                                        <div class="circle-text">
                                            2 or Less Bedrooms
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle">
                                        <div class="circle-text">
                                            3 Bedrooms
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle">
                                        <div class="circle-text">
                                            4 Bedrooms
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle">
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
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[8]->active == 1)
                    <section id="num-of-bathrooms" class='<?php echo ((!$firstActive) ? 'active' : ''); $firstActive = true; ?>'>
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

                            <input type="hidden" name="num-of-bathrooms" value="" />
                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[8]->question }}</h2>
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o">
                                        <div class="circle-text">
                                            1 Bathroom
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o">
                                        <div class="circle-text">
                                            2 Bathrooms
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o">
                                        <div class="circle-text">
                                            3 Bathrooms
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o">
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
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[9]->active == 1)
                    <section id="approx-sq-ft-home" class='<?php echo ((!$firstActive) ? 'active' : ''); $firstActive = true; ?>'>
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
                                    <div class="slider-value"><span>500</span></div>
                                    <div class="slider-container">
                                        <span class="minmax-value">500</span>
                                        <input type="hidden" name="approx-sq-ft-home" value="0"/>
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
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[10]->active == 1)
                    <section id="lot-size-slide" class='<?php echo ((!$firstActive) ? 'active' : ''); $firstActive = true; ?>'>
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
                                    <div class="slider-value"><span>7,000</span></div>
                                    <div class="slider-container">
                                        <span class="minmax-value">7,000</span>
                                        <input type="hidden" name="lot-size-slide" value="0"/>
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
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[11]->active == 1)
                    <section id="num-of-interior-levels" class='<?php echo ((!$firstActive) ? 'active' : ''); $firstActive = true; ?>'>
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

                            <input type="hidden" name="num-of-interior-levels" value="" />
                            <h2>{{ $questionNum++ }}. {{ $fixedQuestions[11]->question }}</h2>
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o">
                                        <div class="circle-text">
                                            1 Story
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o">
                                        <div class="circle-text">
                                            2 Story
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o">
                                        <div class="circle-text">
                                            3 Story
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o">
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
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    @if ($fixedQuestions[12]->active == 1)
                    <section id="year-built" class='<?php echo ((!$firstActive) ? 'active' : ''); $firstActive = true; ?>'>
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
                                    <div class="slider-value"><span>1900</span></div>
                                    <div class="slider-container">
                                        <span class="minmax-value">1900</span>
                                        <input type="hidden" name="year-built" value="0"/>
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
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif

                    <section id="review" class="">
                        <div class="container">
                            <h2>Review</h2>
                            <div class="text-center">
                                <p class="mb5"><b>Congratulations!</b></p>
                                <p class="mb5">You are starting to gain clarity on your next home.</p>
                                <p class="mb5">The next important step is to narrow your list down to you <b>MOST IMPORTANT</b> 10 Choices about your next home.</p>
                                <p class="mb5">These are the the most important aspects of your next home.</p>
                                <p class="mb5">As you click on the choices they will add to your top 10 list on the right side.</p>
                            </div>
                            <div class='row'>
                                <div class='col-lg-9'>
                                    <div class="table-container" id='form-table-container'>
                                        <table class="table-bordered" id='form-table'>
                                            <thead>
                                            <tr>
                                                <th style="width:35%">Questions</th>
                                                <th style="width:45%">Value</th>
                                                <th style="width:10%">Select</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $ct = 0; ?>
                                            @if ($fixedQuestions[2]->active == 1)
                                                <?php $ct++; ?>
                                                {!! Application::formTableValue($ct, $fixedQuestions[2]->tag, $fixedQuestions[2]->question) !!}
                                            @endif
                                            @if ($fixedQuestions[3]->active == 1)
                                                <?php $ct++; ?>
                                                {!! Application::formTableValue($ct, $fixedQuestions[3]->tag, $fixedQuestions[3]->question) !!}
                                            @endif
                                            @if ($fixedQuestions[6]->active == 1)
                                                <?php $ct++; ?>
                                                {!! Application::formTableValue($ct, $fixedQuestions[6]->tag, $fixedQuestions[6]->question) !!}
                                            @endif
                                            @for ($i = 13; $i <= 15; $i++)
                                                @if ($fixedQuestions[$i]->active == 1)
                                                    <?php $ct++; ?>
                                                    {!! Application::formTableValue($ct, $fixedQuestions[$i]->tag, $fixedQuestions[$i]->question) !!}
                                                @endif
                                            @endfor
                                            @foreach ($questions as $question)
                                                <?php $ct++; ?>
                                                {!! Application::formTableValue($ct, $question->tag, $question->question) !!}
                                            @endforeach
                                            @if ($fixedQuestions[0]->active == 1)
                                                <?php $ct++; ?>
                                                {!! Application::formTableValue($ct, $fixedQuestions[0]->tag, $fixedQuestions[0]->question) !!}
                                            @endif
                                            @if ($fixedQuestions[1]->active == 1)
                                                <?php $ct++; ?>
                                                {!! Application::formTableValue($ct, $fixedQuestions[1]->tag, $fixedQuestions[1]->question) !!}
                                            @endif
                                            @if ($fixedQuestions[4]->active == 1)
                                                <?php $ct++; ?>
                                                {!! Application::formTableValue($ct, $fixedQuestions[4]->tag, $fixedQuestions[4]->question) !!}
                                            @endif
                                            @if ($fixedQuestions[5]->active == 1)
                                                <?php $ct++; ?>
                                                {!! Application::formTableValue($ct, $fixedQuestions[5]->tag, $fixedQuestions[5]->question) !!}
                                            @endif
                                            @for ($i = 7; $i <= 12; $i++)
                                                @if ($fixedQuestions[$i]->active == 1)
                                                    <?php $ct++; ?>
                                                    {!! Application::formTableValue($ct, $fixedQuestions[$i]->tag, $fixedQuestions[$i]->question) !!}
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
                                                    <td class="selected-feature" id="feature-{{ $i }}"></td>
                                                </tr>
                                            @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt30">
                                <div class="col-sm-6 col-lg-4 text-left text-center-xs mb20">
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                                <div class="col-sm-6 col-lg-4 col-lg-offset-1 text-right text-center-xs mb20">
                                    <div class="btn btn-custom-o next">Please email me my list</div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="final-section" class="">
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
                                        <input type="text" name="firstname" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="input-desc">Last Name</label>
                                        <input type="text" name="lastname" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="input-desc">Email</label>
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-12'>
                                    <div class="form-group">
                                        <input type="checkbox" name="pre-approved-information" value="1">
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
                                    <div id='phone'>
                                        <div class="phone-number">
                                            <input type="text" name="first-num" class="form-control" maxlength='3'/>
                                        </div>
                                        <span>&ndash;</span>
                                        <div class="phone-number">
                                            <input type="text" name="second-num" class="form-control" maxlength='3'/>
                                        </div>
                                        <span>&ndash;</span>
                                        <div class="phone-number">
                                            <input type="text" name="third-num" class="form-control" maxlength='4'/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="no-schedule-call" value="1">
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
                </div>
            </div>
        </div>
    </section>

@stop

@section('footer')
    @include('footer')
@stop
