
<style>
    body, .navbar, .modal-open { padding-right: 0 !important; overflow: auto !important; }  
</style>
                           
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

                    <p class="text-info">
                        <u>Total Portfolio, Single Rate</u>:<br />
                        Example: $500,000 Investment:<br />
                        <table class="squish text-muted">
                            <tr><td>  </td><th>Investment          </th><th colspan=2>Rate</th><th>Fees</th><td></td></tr>
                            <tr><td>1.</td><td>$0 - $250,000       </td><td>at</td><td> 1.0% =</td><td><s>$2,500</s></td><td></td></tr>
                            <tr><td>2.</td><td>$0 - $500,000       </td><td>at</td><td> 0.5% =</td><td>$1,250</td><td></td></tr>  
                            <tr><td>3.</td><td colspan=3>               Total management fee =</td><td>$1,250</td><td>per year</td></tr>
                        </table>
                    </p>

                    <p class="text-info">
                        <u>Cumulative Rates Per Tier</u>:<br /> 
                        Example: $500,000 Investment:<br />
                        <table class="squish text-muted">
                            <tr><td>  </td><th>Investment          </th><th colspan=2>Rate</th><th>Fees</th><td></td></tr>
                            <tr><td>1.</td><td>$0 - $250,000       </td><td>at</td><td>.5%  =</td><td>$1,250</td><td></td></tr>
                            <tr><td>2.</td><td>$250,000 - $500,000 </td><td>at</td><td>.25% =</td><td>  $625</td><td></td></tr>  
                            <tr><td>3.</td><td colspan=3>              Total management fee =</td><td>$1,875</td><td>per year</td></tr>
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
