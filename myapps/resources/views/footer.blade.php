<footer id="footer" class="footer-inverse">
    <div id="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-push-8">
                    <ul class="footer-menu">
                        <li><a href="{{ asset('/ready-to-dream') }}" class='brown-hover'>Ready to Dream</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-md-pull-4">
                    <p class="copyright"><b>Copyright &copy; 2021</b> Home Dream Builder</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="modal fade no-padding" id="save-draft-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <form name="save-draft-form" method="get" action="#">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-bluegrey">
                    <button type="button" class="close bg-darkblue" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title white">Save your form to finish later.</h3>
                </div>
                <div class="modal-body">
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
                </div>
                <div class="modal-footer bg-bluegrey">
                    <button type="button" class="btn btn-modal btn-modal-close" data-dismiss="modal">CLOSE</button>
                    <input type='submit' name="draft" value="SAVE" class="btn btn-modal btn-modal-save">
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade no-padding" id="more-thoughts-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-black">
                <button type="button" class="close bg-bluegrey" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title white">Pros / Cons, Life Hack</h3>
            </div>
            <div class="modal-body">
                <h3 class="mb30"></h3>
                <div class="mt15" id="pros">
                    <h4 class="mb5"><u>Pros</u></h4>
                    <div></div>
                </div>
                <div class="mt15" id="cons">
                    <h4 class="mb5"><u>Cons</u></h4>
                    <div></div>
                </div>
                <div class="mt15" id="life-hack">
                    <h4 class="mb5"><u>Life Hack</u></h4>
                    <div></div>
                </div>
            </div>
            <div class="modal-footer bg-black">
                <button type="button" class="btn btn-modal btn-modal-close pull-right" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-slider.min.js') }}"></script>
<script src="{{ asset('js/jquery.hoverIntent.min.js') }}"></script>
<script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('js/waypoints.min.js') }}"></script>
<script src="{{ asset('js/waypoints-sticky.min.js') }}"></script>
<script src="{{ asset('js/jquery.debouncedresize.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jflickrfeed.min.js') }}"></script>
<script src="{{ asset('js/jquery.inputmask.bundle.js') }}"></script>
<script src="{{ asset('js/contact.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/tooltipmaster/tooltipster.bundle.min.js') }}"></script>
<script src="{{ asset('js/tooltipmaster/tooltipster.bundle.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/validate-form.js') }}"></script>
<script src="{{ asset('js/footer-at-bottom.js') }}"></script>