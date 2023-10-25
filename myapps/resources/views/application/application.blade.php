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

    <section id="application" class="">
        <div class="container-fluid">
            <div class="row">
                <!--
                <div class="col-md-2">
                    <div id="home-features-list">
                        <ul>
                            @for ($i = 0; $i < count($homeFeaturesList); $i++)
                                @if (array_key_exists('Sub Features', $homeFeaturesList[$i]))
                                <li class="megamenu">
                                    <div class="megamenu-title"><span class='ft-600'>{{ $i + 1 }}.</span> {{ $homeFeaturesList[$i]['Sub Features Title'] }} <span class='collapse-symbol'>&#9660;</span></div>
                                    <ul>
                                    @for ($h = 0; $h < count($homeFeaturesList[$i]['Sub Features']); $h++)
                                        <li>
                                            <a href='#'><span class='ft-600'>{{ ($i + 1) . range('a', 'z')[$h] . '.' }}</span> {{ $homeFeaturesList[$i]['Sub Features'][$h]['Title'] }}</a>
                                        </li>
                                    @endfor
                                    </ul>
                                </li>
                                @else
                                <li class="{{ ($i == 0) ? 'active' : '' }}">
                                    <a href="#"><span class='ft-600'>{{ $i + 1 }}. {{ $homeFeaturesList[$i]['Title'] }}</a>
                                </li>
                                @endif
                            @endfor
                        </ul>
                    </div>
                </div>
                -->
                <div class="col-md-12">
                    {{ Form::open(['url' => 'confirmation', 'name' => 'ready-to-dream-form', 'class' => 'rtd-form']) }}
                    <input type='hidden' name='form-id' value='0' />
                    <input type='hidden' name='status' value='new' />
                    <input type='hidden' name='left-at' value='asking-price' />

                    <section id="asking-price" class='active'>
                        <div class="container">
                            <div class="text-center mb40">
                                <button type="button" class="btn btn-default btn-tooltip tooltip2 top">
                                    More Thoughts
                                    <div class="txt">
                                        <b><u>Pros</u>:</b> &nbsp; N/A <br/>
                                        <b><u>Cons</u>:</b> &nbsp; N/A <br/>
                                        <b><u>Alternatives</u>:</b> &nbsp; N/A
                                    </div>
                                </button>
                            </div>

                            <h2>1. What is your asking price?</h2>
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

                    <section id="monthly-payment" class=''>
                        <div class="container">
                            <h2>2. What is your asking monthly payment?</h2>
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

                    <section id="current-amount" class=''>
                        <div class="container">
                            <h2>3. Current amount set aside for DP?</h2>
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

                    <section id="dwelling-types" class='multiple-choices'>
                        <div class="container">
                            <input type="hidden" name="dwelling-types" value="" />
                            <div class="text-center ft-700">* You can select multiple dwelling types</div>
                            <h2>4. Dwelling Type</h2>
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

                    <section id="dwelling-styles" class=''>
                        <div class="container">
                            <div class="text-center ft-700 mb30">* You can select multiple dwelling styles</div>
                            <input type="hidden" name="dwelling-styles" value="" />
                            <h2>5. Dwelling Style</h2>
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

                    <section id="city" class=''>
                        <div class="container">
                            <div class="row">
                                <h2>6. City</h2>
                                <div class="col-sm-8 col-sm-offset-2">
                                    <input type="text" name="city" class="form-control" placeholder="City"/>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
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

                    <section id="zipcode" class=''>
                        <div class="container">
                            <div class="row">
                                <h2>7. Zip Code</h2>
                                <div class="col-sm-8 col-sm-offset-2">
                                    <input type="text" name="zipcode" class="form-control" placeholder="Ex. 12345,54321,13524"/>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
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

                    <section id="num-of-bedrooms" class=''>
                        <div class="container">
                            <input type="hidden" name="num-of-bedrooms" value="" />
                            <h2>8. # of Bedrooms</h2>
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
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="num-of-bathrooms" class=''>
                        <div class="container">
                            <input type="hidden" name="num-of-bathrooms" value="" />
                            <h2>9. # of Bathrooms</h2>
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o">
                                        <div class="circle-text">
                                            In Contract <br/><br/> NOW
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o">
                                        <div class="circle-text">
                                            Currently Looking <br/><br/> < 30 Days
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o">
                                        <div class="circle-text">
                                            2 - 4 <br/> Months
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="bg-circle-o">
                                        <div class="circle-text">
                                            5+ <br/> Months
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="approx-sq-ft-home" class=''>
                        <div class="container">
                            <h2>10. Approximate Square Ft. Home</h2>
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

                    <section id="lot-size-slide" class=''>
                        <div class="container">
                            <h2>11. Lot Size Slide</h2>
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

                    <section id="num-of-interior-levels" class=''>
                        <div class="container">
                            <input type="hidden" name="num-of-interior-levels" value="" />
                            <h2>12. # of Interior Levels</h2>
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
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="year-built" class=''>
                        <div class="container">
                            <h2>13. Year Built</h2>
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

                    <section id="garage-spaces" class=''>
                        <div class="container">
                            <input type="hidden" name="garage-spaces" value="" />
                            <h2>14. How many cars do you want parked in your Garage Space?</h2>
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
                            <div class="row mt60">
                                <div class="col-md-12 text-center">
                                    <a href="#save-draft" class="btn btn-bluegrey save" data-toggle="modal" data-target="#save-draft-modal">Save as Draft</a>
                                </div>
                            </div>
                        </div>
                    </section>

                    <?php $ct = 14; ?>
                    @for ($i = 14; $i < count($homeFeaturesList); $i++)
                        @if (array_key_exists('Sub Features', $homeFeaturesList[$i]))
                            @for ($h = 0; $h < count($homeFeaturesList[$i]['Sub Features']); $h++)
                                <?php $ct++; ?>
                                {!! Application::yesNoQuestion($ct, $homeFeaturesList[$i]['Sub Features'][$h]['Section ID'], $homeFeaturesList[$i]['Sub Features'][$h]['Class'], $homeFeaturesList[$i]['Sub Features'][$h]['Title']) !!}
                            @endfor
                        @else
                            <?php $ct++; ?>
                            {!! Application::yesNoQuestion($ct, $homeFeaturesList[$i]['Section ID'], $homeFeaturesList[$i]['Class'], $homeFeaturesList[$i]['Title']) !!}
                        @endif
                    @endfor

                    <section id="review" class="">
                        <div class="container">
                            <h2>Review</h2>
                            <p align='center'>
                                Review this form and make any changes before submitting.
                                <br/>
                                Select your top 10 features before submitting the form.
                            </p>
                            <div class='row'>
                                <div class='col-lg-9'>
                                    <div class="table-container" id='form-table-container'>
                                        <table class="table-bordered" id='form-table'>
                                            <thead>
                                            <tr>
                                                <th style='width:10%'></th>
                                                <th style="width:35%">Questions</th>
                                                <th style="width:45%">Value</th>
                                                <th style="width:10%">Select</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $ct = 0; ?>
                                            @for ($i = 0; $i < count($homeFeaturesList); $i++)
                                                @if (array_key_exists('Sub Features', $homeFeaturesList[$i]))
                                                    @for ($h = 0; $h < count($homeFeaturesList[$i]['Sub Features']); $h++)
                                                        <?php $ct++; ?>
                                                        {!! Application::formTableValue($ct, $homeFeaturesList[$i]['Sub Features'][$h]['Section ID'], $homeFeaturesList[$i]['Sub Features'][$h]['Title']) !!}
                                                    @endfor
                                                @else
                                                    <?php $ct++; ?>
                                                    {!! Application::formTableValue($ct, $homeFeaturesList[$i]['Section ID'], $homeFeaturesList[$i]['Title']) !!}
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
