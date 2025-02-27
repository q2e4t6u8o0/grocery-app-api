<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <meta http-equiv="Content-Type" content="text/html;"/>
    <meta charset="UTF-8">
	<style media="all">
		*{
			margin: 0;
			padding: 0;
			line-height: 1.3;
			font-family: sans-serif;
			color: #333542;
		}
		body{
			font-size: .875rem;
		}
		.gry-color *,
		.gry-color{
			color:#878f9c;
		}
		table{
			width: 100%;
		}
		table th{
			font-weight: normal;
		}
		table.padding th{
			padding: .5rem .7rem;
		}
		table.padding td{
			padding: .7rem;
		}
		table.sm-padding td{
			padding: .2rem .7rem;
		}
		.border-bottom td,
		.border-bottom th{
			border-bottom:1px solid #eceff4;
		}
		.text-left{
			text-align:left;
		}
		.text-right{
			text-align:right;
		}
		.small{
			font-size: .85rem;
		}
		.currency{

		}
		.text-success{
			color: green;
		}
	</style>
</head>
<body>
	<div>

		@php
			$generalsetting = \App\GeneralSetting::first();
		@endphp

		<div style="background: #eceff4;padding: 1.5rem;">
			<table>
				<tr>
					<td>
						@if($generalsetting->logo != null)
							<img loading="lazy"  src="{{ asset($generalsetting->logo) }}" height="40" style="display:inline-block;">
						@else
							<img loading="lazy"  src="{{ asset('frontend/images/logo/logo.png') }}" height="40" style="display:inline-block;">
						@endif
					</td>
					<td style="font-size: 2.5rem;" class="text-right strong">INVOICE</td>
				</tr>
			</table>
			<table>
				<tr>
					<td style="font-size: 1.2rem;" class="strong">{{ $generalsetting->site_name }}</td>
					<td class="text-right"></td>
				</tr>
				<tr>
					<td class="gry-color small">{{ $generalsetting->address }}</td>
					<td class="text-right"></td>
				</tr>
				<tr>
					<td class="gry-color small">Email: {{ $generalsetting->email }}</td>
					<td class="text-right small"><span class="gry-color small">Order ID:</span> <span class="strong">{{ $order->code }}</span></td>
				</tr>
				<tr>
					<td class="gry-color small">Phone: {{ $generalsetting->phone }}</td>
					<td class="text-right small"><span class="gry-color small">Order Date:</span> <span class=" strong">{{ date('d-m-Y', $order->date) }}</span></td>
				</tr>
			</table>

		</div>

        <div style="padding: 1.5rem;padding-bottom: 0; ">
            
            <table>
                @php
                    $shipping_address = json_decode($order->shipping_address);
                @endphp
                <tr><td class="strong small gry-color">Bill to:</td></tr>
                <tr><td class="strong">{{ $shipping_address->name }}</td></tr>
                <tr><td class="gry-color small">{{ $shipping_address->address }}, {{ $shipping_address->city }}, {{ $shipping_address->country }}</td></tr>
                <tr><td class="gry-color small">Email: {{ $shipping_address->email }}</td></tr>
                <tr><td class="gry-color small">Phone: {{ $shipping_address->phone }}</td></tr>
            </table>
		</div>

	    <div style="padding: 1.5rem;">
			<table class="padding text-left small border-bottom">
				<thead>
	                <tr class="gry-color" style="background: #eceff4;">
	                    <th width="35%">Product Name</th>
						<th width="15%">Delivery Type</th>
	                    <th width="10%">Qty</th>
	                    <th width="15%">Unit Price</th>
	                    <th width="10%">Tax</th>
	                    <th width="15%" class="text-right">Total</th>
	                </tr>
				</thead>
				<tbody class="strong">
	                @foreach ($order->orderDetails as $key => $orderDetail)
		                @if ($orderDetail->product != null)
							<tr class="">
								<td>{{ $orderDetail->product->name }} ({{ $orderDetail->variation }})</td>
								<td>
									@if ($orderDetail->shipping_type != null && $orderDetail->shipping_type == 'home_delivery')
										{{ __('Home Delivery') }}
									@elseif ($orderDetail->shipping_type == 'pickup_point')
										@if ($orderDetail->pickup_point != null)
											{{ $orderDetail->pickup_point->name }} ({{ __('Pickip Point') }})
										@endif
									@endif
								</td>
								<td class="gry-color">{{ $orderDetail->quantity }}</td>
								<td class="gry-color currency">{{ single_price($orderDetail->price/$orderDetail->quantity) }}</td>
								<td class="gry-color currency">{{ single_price($orderDetail->tax/$orderDetail->quantity) }}</td>
			                    <td class="text-right currency">{{ single_price($orderDetail->price+$orderDetail->tax) }}</td>
							</tr>
		                @endif
					@endforeach
	            </tbody>
			</table>
		</div>

        <div style="padding:0 1.5rem;">
            <div style="float:left; ">
                <img src="{{url('/')}}/public/Cancel.png" style="width: 125px;">
            </div>
	        <table style="width: 40%;margin-left:auto;" class="text-right sm-padding small strong">
		        <tbody>
			        <tr>
			            <th class="gry-color text-left">Sub Total</th>
			            <td class="currency">{{ single_price($order->orderDetails->sum('price')) }}</td>
			        </tr>
			        <tr>
						<th class="gry-color text-left">Shipping Cost {{ucfirst(str_replace('_',' ',$order->payment_type))}}</th>
						@if ($order->payment_type=='wallet')
							<td class="currency">{{ single_price(0) }}</td>
						@else
							<td class="currency">{{ single_price($order->orderDetails->sum('shipping_cost')) }}</td>
						@endif
			            
			        </tr>
			        <tr class="border-bottom">
			            <th class="gry-color text-left">Total Tax</th>
			            <td class="currency">{{ single_price($order->orderDetails->sum('tax')) }}</td>
					</tr>
					@php
                                                        
						if ($order->cashback_coupon==1) {
							$CashbackCronjob = \App\CashbackCronjob::where('user_id', $order->user_id)->where('order_id',$order->id)->first();
					
							@endphp
								<tr >
									<th><small class="text-success"><b>{{__('coupon Applyed')}}</b></small><br><small style="font-family: Georgia, 'Times New Roman', Times, serif">{{ json_decode($CashbackCronjob->json)->coupon_code }}</small></th>
									<td class="text-right">
										<small style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif" class="text-success"> </small><span style="font-size:9px;" class="text-success"><b><?php echo single_price2(json_decode($CashbackCronjob->json)->coupon_discount);?></b> Cashback credit in your wallet with in 24 hr</span> 
									</td>
								</tr>
							@php
						}else{
							@endphp
								<tr>
									<th>{{__('Coupon Discount')}}</th>
									<td class="text-right">
										<span class="text-italic"><i>{{ single_price($order->coupon_discount) }}</i></span>
									</td>
								</tr>
							@php
						}
					@endphp
			        <tr>
						<th class="text-left strong">Grand Total</th>
						@if ($order->payment_type=='wallet')
							<td class="currency">{{ single_price(($order->grand_total)) }}</td>
						@else
							<td class="currency">{{ single_price($order->grand_total) }}</td>
						@endif
			            
			        </tr>
		        </tbody>
		    </table>
	    </div>

	</div>
</body>
</html>