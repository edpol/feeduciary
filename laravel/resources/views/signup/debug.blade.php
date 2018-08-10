<div class="form-group text-warning">

    @if (auth()->check())
        advisor logged in
    @else
        Not logged in
    @endif
    <br />

    @if ($verified==="")
        verified is null, no cookie
    @endif
    @if ($verified===true)
        verified is true, found cookie
    @endif
    @if ($verified===false)
        verified is false, found cookie
    @endif
    <br />
</div>
