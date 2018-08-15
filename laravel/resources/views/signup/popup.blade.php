                <div class="modal fade" id="yourModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header bg-primary text-white">
                                <h4 class="modal-title" id="myModalLabel">
                                    Please select
                                </h4>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    &times;
                                </button>
                            </div>

                            <div class="modal-body text-left bg-light text-dark">
                                <div class="m-3">
                                     <div class="modal-footer row text-left pr-0">

<div class="ml-0">Do you want to mark records as downloaded?</div>

<button type="submit" class="btn btn-info mr-1" name="update" value="y" 
formaction="{{ url('/signup/csv/list') }}">Yes</button>

<!-- data-dismiss="modal" kills url execution -->

<button type="submit" class="btn btn-info mr-0" name="update" value="y" 
formaction="{{ url('/signup/csv/list') }}">No</button>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
