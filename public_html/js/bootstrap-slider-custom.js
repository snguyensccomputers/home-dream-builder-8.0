var following_years = 'good-living';

$(document).ready(function(){

    /* -------------------- Slider / Salary Calculator -------------------- */
    $('.slider.slider-horizontal .tooltip').hide();

    $('#earnings > span').html(commaSeparateNumber($('#salary-slider').val()));

    salary_calculation();
    $('#salary-slider').change(function(){
        salary_calculation();
    });

    area_chart_axis();

    $('#btn-policies > button').click(function(){
        $('#btn-policies > button').removeClass('active');
        $(this).addClass('active');
        following_years = $(this).attr('id');

        salary_calculation();
    });

    area_chart_font_size();
    
    /*
    $("input[name='salary-input']").change(function(){
        var handleRange;
        var maxSliderValue = parseInt($("#salary-slider").attr("data-slider-max"));

        if ($(this).val() > maxSliderValue) {
            handleRange = maxSliderValue / 100;
            $('.slider.slider-horizontal .tooltip-inner').html(maxSliderValue);
            $(this).val(maxSliderValue);
        }
        else if ($(this).val() < 0) {
            $('.slider.slider-horizontal .tooltip-inner').html(0);
            $(this).val(0);
        }
        else {
            handleRange = $(this).val() / 100;
            $('.slider.slider-horizontal .tooltip-inner').html($(this).val());
        }

        $('.slider-selection').css('width', handleRange + '%');
        $('.slider-track-right').css('width', (100 - handleRange) + '%');
        $('.min-slider-handle').css('left', handleRange + '%');

        $('#earnings > span').html($('.slider.slider-horizontal .tooltip-inner').html());
    });
    */
});

$(window).resize(function(){
    var x_axis_position = $( '.flot-x-axis > div' ).position();
    var x_axis_last_position = $( '.flot-x-axis > div:last-child' ).position();

    $( '.flot-x-axis > div' ).css('top', (x_axis_position.top) + 'px');

    area_chart_font_size();
});

/* -------------------- Salary Calculation -------------------- */
function salary_calculation() {
    $('#earnings > span').html(commaSeparateNumber($('.slider.slider-horizontal .tooltip-inner').html()));

    var ideal_salary = parseInt($('.slider.slider-horizontal .tooltip-inner').html());
    var policies_per_year = Math.ceil(ideal_salary / (0.05 * 1000 * 12));
    var policies_per_month = Math.ceil(policies_per_year / 12);

    /*
     Policies
     $600 = 1 Policy

     Policies per year
     $50,000  = 83  per year
     $100,000 = 167 per year
     $150,000 = 250 per year
     $200,000 = 333 per year
     $250,000 = 417 per year
     $300,000 = 500 per year
     $350,000 = 583 per year

     Policies per month
     $50,000  = 7  per month
     $100,000 = 14 per month
     $150,000 = 21 per month
     $200,000 = 28 per month
     $250,000 = 35 per month
     $300,000 = 42 per month
     $350,000 = 49 per month

     Salary
     $600 * 12 * 6  = $43,200
     $600 * 12 * 7  = $50,400
     $600 * 12 * 8  = $57,600
     $600 * 12 * 9  = $64,800
     $600 * 12 * 10 = $72,000

     7  per month = $43,201 - $50,400
     8  per month = $50,401 - $57,600
     9  per month = $57,601 - $64,800
     10 per month = $64,801 - $72,000
     */

    $('#first-year .estimated-insurance-policies > u').html(commaSeparateNumber(policies_per_year));
    $('#first-year .insurance-policies-per-month > u').html(commaSeparateNumber(policies_per_month));

    var increase;
    var future_policies_to_sell;
    switch (following_years) {
        case 'good-living':
            increase = .20;
            future_policies_to_sell = Math.round(policies_per_year * 0.5);
            break;
        case 'crush-it':
            increase = .50;
            future_policies_to_sell = parseInt(policies_per_year);
            break;
    }

    $('#following-years .estimated-insurance-policies > u').html(commaSeparateNumber(future_policies_to_sell));
    $('#following-years .insurance-policies-per-month > u').html(commaSeparateNumber(future_policies_to_sell * 5));

    // $('#following-years .insurance-policies-per-month > u').html(commaSeparateNumber(Math.ceil(policies_per_month) + (Math.ceil(policies_per_month) * 0.5)));

    var data = [{
        "data": [
            ["Year 1", ideal_salary + (ideal_salary * increase)],
            ["Year 2", (ideal_salary * 2) + ((ideal_salary * 2) * increase)],
            ["Year 3", (ideal_salary * 3) + ((ideal_salary * 3) * increase)],
            ["Year 4", (ideal_salary * 4) + ((ideal_salary * 4) * increase)],
            ["Year 5", (ideal_salary * 5) + ((ideal_salary * 5) * increase)]
        ]
    }];
    $.plot($('.chart-area'), data, options());

    area_chart_axis();
}

/* -------------------- Area Chart -------------------- */
function area_chart_axis() {
    $('.flot-x-axis > div, .flot-y-axis > div').css('font-size', '14px');

    var x_axis_position = $( '.flot-x-axis > div' ).position();
    var x_axis_first_position = $( '.flot-x-axis > div:first-child' ).position();
    var x_axis_last_position = $( '.flot-x-axis > div:last-child' ).position();

    var y_axis_position;
    if ($(window).width() < 447) {
        $('.flot-y-axis > div').each(function () {
            y_axis_position = $(this).position();
            $(this).css('left', (y_axis_position.left) + 'px');
        });

        $('.flot-x-axis > div:first-child').css('left', (x_axis_first_position.left) + 'px');
        $('.flot-x-axis > div:last-child').css('left', (x_axis_last_position.left) + 'px');
    }
    else {
        $('.flot-x-axis > div').css('top', (x_axis_position.top + 3) + 'px');

        $('.flot-x-axis > div:first-child').css('left', (x_axis_first_position.left + 4) + 'px');
        $('.flot-x-axis > div:last-child').css('left', (x_axis_last_position.left - 4) + 'px');

        $('.flot-y-axis > div').each(function () {
            y_axis_position = $(this).position();
            $(this).css('left', (y_axis_position.left - 5) + 'px');
        });
    }
}

function area_chart_font_size() {
    if ($(window).width() < 447) {
        $('.flot-x-axis > div').each(function(){
            $(this).css('font-size', '12px');
        });

        $('.flot-y-axis > div').each(function(){
            $(this).css('font-size', '12px');
        });
    }
    else {
        $('.flot-x-axis > div').each(function(){
            $(this).css('font-size', '14px');
        });

        $('.flot-y-axis > div').each(function(){
            $(this).css('font-size', '14px');
        });
    }
}

function options() {
    var options = {
        series: {
            lines: {
                show: true,
                lineWidth: 0,
                fill: 0.8,
                fillColor: { colors: ['#feb2ff', '#e48ae6', '#ca66cc', "#b247b3"] }
            },
            points: {
                show: false,
                radius: 4
            }
        },
        grid: {
            borderColor: '#d9d9d9',
            borderWidth: 2,
            hoverable: true,
            backgroundColor: "#fafafa"
        },
        tooltip: true,
        tooltipOpts: {
            content: function (label, x, y) { return x + ' : ' + '$' + y + 'K'; }
        },
        xaxis: {
            tickColor: '#e6e6e6',
            mode: 'categories',
            font: 'Calibri',
            color: '#b1b1b1'
        },
        yaxis: {
            min: 0,
            tickColor: '#eee',
            position: 'left',
            font: 'Calibri',
            color: '#b1b1b1',
            tickFormatter: function (v) {
                if (v >= 1000000)
                    return '$' + (v / 1000000) + 'M';
                else if (v >= 1000)
                    return '$' + (v / 1000) + 'K';
                else {
                    if ((v > 0.6 && v < 0.7) ||
                        (v > 1.2 && v < 1.3))
                        v = v.toFixed(1);

                    return '$' + v;
                }
            }
        },
        shadowSize: 0
    };

    return options;
}

function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
        val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
}