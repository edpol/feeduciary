<!-- popup -->
<div class="bs-example">
    <!-- Button HTML (to Trigger Modal) -->
    <label class="col-md-8 control-label">Fee Calculation Formula*
        <a href="#myModal" class="btn-xs" data-toggle="modal"><img src="{{ asset('images/information.gif') }}" alt="Rate Plans" title"information"/></a>
    </label>
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cumulative vs. Rate Change options</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body col-centered">

                    <p>
                        <u>Total Portfolio, Single Rate</u>:<br />
                        Example: $500,000 Investment:<br />
                        <table class="squish">
                            <tr><td>  </td><th>Investment     </th><th colspan=2>Rate    </th><th>Fees         </th></tr>
                            <tr><td>1.</td><td>$0 - $250,000  </td><td>at</td><td> 1.0% =</td><td><s>$2,500</s></td></tr>
                            <tr><td>2.</td><td>$0 - $500,000  </td><td>at</td><td>  .5% =</td><td>   $1,250    </td></tr>  
                            <tr><td>3.</td><td colspan=3>      Total mgt fee (per year) =</td><td>   $1,250    </td></tr>
                        </table>
                    </p>

                    <p>
                        <u>Cumulative Rates Per Tier</u>:<br /> 
                        Example: $500,000 Investment:<br />
                        <table class="squish">
                            <tr><td>  </td><th>Investment          </th><th colspan=2>Rate   </th><th>Fees  </th></tr>
                            <tr><td>1.</td><td>$0 - $250,000       </td><td>at</td><td>.5%  =</td><td>$1,250</td></tr>
                            <tr><td>2.</td><td>$250,000 - $500,000 </td><td>at</td><td>.25% =</td><td>  $625</td></tr>  
                            <tr><td>3.</td><td colspan=3>          Total mgt fee (per year) =</td><td>$1,875</td></tr>
                        </table>
                    </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
