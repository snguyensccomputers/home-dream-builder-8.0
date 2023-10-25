<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ isset($pageTitle) ? $pageTitle : 'Page' }} | Home Dream Builder</title>
<meta name="description" content="{{ isset($pageDescription) ? $pageDescription : 'Description' }}">
<meta name="keywords" content="{{ isset($pageKeywords) ? $pageKeywords : 'Keywords' }}">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap-slider.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
<link rel="stylesheet" href="{{ asset('css/vspacing.css') }}">
<link rel="stylesheet" href="{{ asset('css/tooltip.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<!-- Tooltipster -->
<link rel="stylesheet" href="{{ asset('css/tooltipmaster/tooltipster.bundle.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/tooltipmaster/tooltipster-sideTip-borderless.min.css') }}" />
<!-- Font Google APIs -->
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Montserrat:300,400,600,700">
<!-- ReCaptcha -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- Favicon and Apple Icons -->
<link rel="icon" href="{{ asset('images/cml/favicon-32x32.png') }}">
<!-- Modernizr -->
<script src="{{ asset('js/modernizr.js') }}"></script>
<!--- jQuery -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- Autocomplete -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.2.27/jquery.autocomplete.min.js"></script>
