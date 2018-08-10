                <div class="modal fade" id="yourModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header bg-primary text-white">
                                <h4 class="modal-title" id="myModalLabel">
@if ($verified===false)
Do you want to resend the verification email or submit a new email?
@else
Enter your email address to access Feeduciary's free fee-based advisor search features.
@endif
                                </h4>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    &times;
                                </button>
                            </div>

                            <div class="modal-body text-left bg-light text-dark">
                                <div class="m-3">
                                    <div class="form-group my-3 my-md-2 row">
                                        <label class="col-md-2 pt-2" for="email">*Email:</label>
                                        <input class="form-control col-md-9 col-12" type="email" id="email" name="email" value="{{ $email }}" autofocus />
                                    </div>
                                    <div class="form-group mb-2 mb-md-3 row">
                                        <label class="col-md-2 pt-2" for="name">Name:</label>
                                        <input class="form-control col-md-9 col-12" type="text"  id="name"  name="name"  value="{{ $name }}" />
                                    </div>
 @include('signup.debug')
                                    <div class="modal-footer row">
                                        @guest
                                        <button type="submit" class="btn btn-info    mb-1 col-md-5 col-12 mr-0" formaction="{{ url('/register') }}">Advisors Register Here</button>
                                        @endguest
                                        <button type="button" class="btn btn-default mb-1 col-md-2 col-12 mr-0" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary mb-1 col-md-2 col-12 mr-0">Save</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>