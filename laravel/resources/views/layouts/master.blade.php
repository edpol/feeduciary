<!DOCTYPE html>
<html lang="en">
<head class="no-js">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="The singular focus of Feeduciary.com is to connect fee conscious investors seeking investment advice with fee-based financial advisors." />
	<meta name="keywords" content="Feeduciary, fiduciary, fiduciaries, Fee, Cost, Annual, Advisor, Commission, Fee based, Fee only, Fiduciary Rule, Custodian, Leverage, Save, Time, Wealth, Financial, Consulting, Advice, Stocks, 401k, roth, IRA, savings, cheap, discount, independent, dealer, Broker, RIA, Registered, Investment, Mutual fund, ETF, CD, Savings, Growth, Value, Small cap, Large cap, Mid cap, Dollars, Annuity, REIT, Fixed, Variable, Interest Rate, Inflation, Retirement, Calculator, Planner, Financial, CFP, CFA, Plan, Save, Economy, Market, CMBS, MBS, Agency, Debt, Tax free, Sec, Finra, Broker dealer check, Taxable, Refinance, Compete, Facilitate, SEC Rule, Liquidity, Loan, Bank, Rate, Effective, Reform, Short Duration, Vanguard, Fidelity, Real estate, Loomis, Prudential, Invesco, Eaton Vance, Putnam, natixis, JP Morgan, MLP, Pipeline, Midstream, Upstream, Downstream, Floating rate, High yield, Low, Dividend, Income, Distribution, Credit, Risk, Capital gain, Long term, Short term, NAV, Technology, Discount, rule, Sensitive, Reoccurring, Alternative, Schwab, Fidelity" />
	<title>Feeduciary <?php if (isset($tab)) { echo " | {$tab}"; } ?></title>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" />
	<!-- Custom fonts for this template -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" />
	<!-- Custom styles for this template -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/landing-page.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/feeduciary.css') }}" />

	@if (env('APP_ENV') != 'development')
		@include('layouts.analytics')
		@include('layouts.pixel')
	@endif
</head>
<body>

    @include('layouts.nav')

    @yield('box1')

    @yield('box2')

    @yield('box3')

    @yield('box4')

    @include('layouts.footer')

<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/myscript.js') }}"></script>
</body>
</html>