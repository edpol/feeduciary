                <div class="modal fade" id="yourModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header bg-primary text-white">
                                <h4 class="modal-title" id="myModalLabel">Please enter email address</h4>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    &times;
                                </button>
                            </div>

                            <div class="modal-body text-left bg-light text-dark">
                                <form method="GET" action="{{url('/saveEmail')}}">
                                    {{ csrf_field() }}
                                    <div class="m-3">
                                        <div class="form-group my-3 my-md-2 row">
                                            <label class="col-md-2 pt-2" for="email">*Email:</label>
                                            <input class="form-control col-md-9 col-12" type="email" id="email" name="email" autofocus />
                                        </div>
                                        <div class="form-group mb-2 mb-md-3 row">
                                            <label class="col-md-2 pt-2" for="email">Name:</label>
                                            <input class="form-control col-md-9 col-12" type="text"  id="name"  name="name" />
                                        </div>

<div class="form-group text-success">
    @if (auth()->check())
        advisor logged in
    @else
        Not logged in
    @endif
    <br />
    <!-- this is set to true or false before we get to this page -->
    @if (request()->cookie('ask_for_email')===true)
        cookie ask_for_email is TRUE {{ session('ask_for_email') }}
    @else
        cookie ask_for_email is NOT TRUE {{ session('ask_for_email') }}
    @endif
    <br />
    @if (request()->cookie('email'))
        found cookie email {{ request()->cookie('email') }}
    @else
        did NOT find cookie email
    @endif
    <br />
</div>

                                        <div class="modal-footer row">
                                            @guest
                                            <button type="submit" class="btn btn-info    mb-1 col-md-5 col-12 mr-0" formaction="{{ url('/register') }}">Advisors Register Here</button>
                                            @endguest
                                            <button type="button" class="btn btn-default mb-1 col-md-2 col-12 mr-0" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary mb-1 col-md-2 col-12 mr-0" formaction="{{ url('/register') }}">Save</button>
                                        </div>
                                    </div>

                                </form>
                                @include('layouts.errors') 

                            </div>

                        </div>
                    </div>
                </div>