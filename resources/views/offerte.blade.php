<!DOCTYPE html >
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Generator</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style type="text/css" media="all">
	@page{ 
		margin-left: 0;
		margin-right: 0;
		margin-top: 0;
	}
	</style>
</head>
<body>
	<!-- information About user and our company -->
	<div style="height:340px; background-color: #E4E5E4;">
		<div class="row">
			<div class="col-lg-6 mr-5" style="text-align: right;">
				<div class="mb-2">
					<img src="../public/img/logo.png" alt="logo"  style="height: 80px; width: 130px; margin-bottom: 6px;" class="mt-4">
				</div>
				<div class="mt-4">
    			<h5 class="mb-4" style="color:#726366;">{{$company->name}}</h5>
    			<p  class="mb-0" style="color:#4A4143;">{{$company->phone}}</p>
    			<p  class="mb-0" style="color:#4A4143;">{{$company->email}}</p>
    			<p  class="mb-0" style="color:#4A4143;">{{$company->address . ', ' . $company->zip . ' ' . $company->city}}</p>
				</div>
    		</div>
			<div class="col-lg-6" style="text-align: left;">
				<div class="text-white text-center ml-5 mb-2 font-weight-bold align-text-bottom" style="height: 110px; width: 150px; background-color: #FAA730;">
					<p style="padding-top: 80px;">OFFERTE</p>
				</div>
				<div class="ml-5 mt-4">
					<h5 class="mb-4" style="color:#726366;">{{$user->company_name}}</h5>
					<p  class="mb-0" style="color:#4A4143;">{{$user->name}}</p>
					<p  class="mb-0" style="color:#4A4143;">{{$user->email}}</p>
					<p  class="mb-0" style="color:#4A4143;">{{$user->address. ', ' . $user->zip . ' ' . $user->city}}</p>
				</div>
				<div style="border-top: 1px solid gray; margin-top: 25px; margin-right: 35px; margin-left: 42px;">
					<div class="mr-1" style="float: right; color:#FAA730;">{{ $quotation->created_at->format('j F Y') }}</div>
					<p class="ml-1" style="float: left; color:#FAA730;">Offerte # {{ $newNumber }}</p>
				</div>
			</div>
		</div>
	</div>
	<!-- end of information -->

	<!-- body of quotation(phase, description, price) and subtotal, tax, totaal price -->
	<div class="container mt-1" style="height:auto;">
		<div class="row">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table table-borderless">
						<thead>
							<tr>
								<th style="color:#B9BBB9;">BESCRIHVING</th>
								<th></th>
								<th class="text-right mr-3" style="color:#B9BBB9;">TOTAALPRIJS</th>
							</tr>
						</thead>
						@foreach($quotation->phases as $key => $phase)
							<tr>
								<td style="width: 10px;">{{ $key }}</td>
								<td>
									<table>
										@foreach($phase['features'] as $feature)
											<tr>
												<td  class="py-0">
													<li style="color: orange; width: 400px;">
														<small class="text-dark">
														{{ $feature['description'] }}
														</small>
													</li>
												</td>	
											</tr>
										@endforeach
									</table>
								</td>
								<td class="text-right font-normal mr-3">€ {{number_format($phase['total_price'], 2) }}</td>
							</tr>
						@endforeach
					</table>
	<!-- end of qoutation's body -->

	<!-- Totaal price with tax -->
					<div class="float-right fixed-bottom" style="border-top: 1px solid gray; bottom: 150px; right:16px; color: #4A4143; margin-top: 52px;">
						<div class="mt-3">
							<div class="font-weight-bold d-inline-block px-2" >SUBTOTAAL</div>
							<div class="font-weight-bold d-inline-block px-2" style="margin-left: 20px;">€{{ number_format($quotationTotalPrice , 2)}}</div>
						</div>
						<div>
							<div class="d-inline d-inline-block px-2">BTW21% </div>
							<div class="d-inline d-inline-block px-4" style="margin-left: 30px;">€{{number_format($btw = $quotationTotalPrice * 0.21 , 2)}}</div>
						</div>
						<div>
							<div class="d-inline d-inline-block px-2">TOTAAL</div>
							<div class="d-inline d-inline-block px-4" style="margin-left: 40px;">€{{number_format($btw += $quotationTotalPrice , 2)}}</div>
						</div>		
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end of price -->

	<!-- footer(BTW Number, Bank account, kvk Number) -->
	<div class="container fixed-bottom">
		<p class="d-inline-block px-4 text-center" style="color: #4A4143; font-size: 14px;">BTW-nummer:{{$company->btw}}</p> 
		<p class="d-inline-block px-5 text-center" style="color: #4A4143; font-size: 14px;">IBAN:{{$company->iban}}</p> 
		<p class="d-inline-block px-4 text-center" style="color: #4A4143; font-size: 14px;">KVK-nummer:{{$company->kvk}}</p>
	</div>
	<!-- end of Footer -->
</body>
</html>