<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>Return e-Ticket</title>

		<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
		
	</head>

	<style>
		* {
			font-family: Verdana, Arial, sans-serif;
		}

		.table-heading{
			background-color: teal;
		}

		.row-container {
			width: 100%;
			table-layout: fixed;
		}

		.row-cell {
			width: 33.33%; /* Divide the row into three equal parts */
			vertical-align: top;
			padding: 10px;
		}

		.hr-divider {
			border: 10px solid teal; /* Remove default border */
		}

		.teal-border-table {
            border-collapse: collapse;
            width: 100%;
			text-align: center;
        }

        .teal-border-table .tables-head, .teal-border-table .tables-data {
            border: 2px solid teal;
            padding: 8px;
        }

        .teal-border-table .tables-head {
            background-color: teal;
            color: white;
        }

		.guidelines-table {
            border-collapse: collapse;
            width: 100%;
			text-align: left;
        }

		.guidelines-table .guidelines-head, .guidelines-table .tables-data {
            border: 2px solid teal;
            padding: 8px;
        }

        .guidelines-table .guidelines-head {
            background-color: teal;
            color: white;
        }

	</style>

	<body>
		@foreach ($returnPassengers as $passenger)
		<div class="h-full w-full">
			<table class="w-full">
				<tr>
					<td>
						<p class="text-4xl font-bold">TripWise</p>
						<p class="text-base font-bold">Official e-Ticket Receipt</p>
					</td>
					<td class="text-right">
						<img src="data:image/png;base64,{{ $data['qrcode'] }}" class="pr-12">
						<p class="text-base pt-1">Reference Number: <span class="font-bold">{{$returnBooking->reference_number}}</span></p>
					</td>
				</tr>
			</table>
			<div class="pl-3">
				<p class="text-base font-bold">Booking Details</p>
			</div>
			<hr class="hr-divider">
			<table class="row-container">
				<tr>
					<td class="row-cell">	
						<p class="text-sm">Status:</p>
						<p class="text-sm">Booking Date:</p>
					</td>
					<td class="row-cell">
						<p class="text-sm">{{$returnBooking->status}}</p>
						<p class="text-sm">{{ $returnBooking->created_at->format('M d, Y h:i A') }}</p>
					</td>
					<td class="row-cell">
						<p class="text-sm">Payment Method:</p>
						<p class="text-sm">Booking Type:</p>
					</td>
					<td class="row-cell">
						<p class="text-sm">{{$payment->payment_method}}</p>
						<p class="text-sm">{{$returnBooking->trip_type}}</p>
					</td>
				</tr>
			</table>
			<div class="pl-3">
				<p class="text-base font-bold">Travel Details</p>
			</div>
			<table class="teal-border-table">
				<tr class="text-sm">
					<th class="tables-head">Vessel</th>
					<th class="tables-head">Origin</th>
					<th class="tables-head">Destination</th>
					<th class="tables-head">Class</th>
					<th class="tables-head">Seat</th>
				</tr>
				<tr class="text-sm">
					<td class="tables-data">
						<p>{{$retSchedData->name}}</p>
					</td>
					<td class="tables-data">
						<p>{{$retSchedData->departure_port}}</p>
						<p>{{date('M d, Y', strtotime($retSchedData->departure_date)) . " " . date("g:i a", strtotime($retSchedData->departure_time))}}</p>
					</td>
					<td class="tables-data">
						<p>{{$retSchedData->arrival_port}}</p>
						<p>{{date('M d, Y', strtotime($retSchedData->arrival_date)) . " " . date("g:i a", strtotime($retSchedData->arrival_time))}}</p>
					</td>
					<td class="tables-data">{{$passenger->accommodation}}</td>
					<td class="tables-data">{{$passenger->seat->seat_number}}</td>
				</tr>
			</table>
			<div class="pl-3 pt-3">
				<p class="text-base font-bold">Contact Details</p>
			</div>
			<table class="teal-border-table">
				<tr class="text-sm">
					<th class="tables-head">Information</th>
					<th class="tables-head">Contact</th>
				</tr>
				<tr class="text-sm">
					<td class="tables-data">
						<p>{{$contactPerson->name}}</p>
						<p>{{$contactPerson->address}}</p>
					</td>
					<td class="tables-data">
						<p>{{$contactPerson->email}}</p>
						<p>{{$contactPerson->phone}}</p>
					</td>
				</tr>
			</table>
			<div class="pl-3 pt-3">
				<p class="text-base font-bold">Passenger Details</p>
			</div>
			<table class="teal-border-table">
				<tr class="text-sm">
					<th class="tables-head">Information</th>
					<th class="tables-head">Purchase Description</th>
				</tr>
				<tr class="text-xs">
					<td class="tables-data">
						<table class="w-full">
							<tr>
								<td>
									<p>Full Name:</p>
									<p>Birthdate:</p>
									<p>Gender:</p>
									<p>Classification:</p>
								</td>
								<td>
									<p>{{ $passenger->first_name }} {{ substr($passenger->middle_name, 0, 1) }} {{ $passenger->last_name }}</p>
									<p>{{date('M d, Y', strtotime($passenger->birthdate))}}</p>
									<p>{{$passenger->gender}}</p>
									<p>{{$passenger->discount_type}}</p>
								</td>
							</tr>
						</table>
					</td>
					<td class="tables-data">
						<table class="w-full">
							<tr>
								<td>
									<p>Departure:</p>
									<p>Return:</p>
									<p>Discount:</p>
									<p>Service Charge:</p>
									<p>Total:</p>
								</td>
								<td>
									<p>PHP {{$payment->depart_total}}</p>
									<p>PHP {{$payment->return_total}}</p>
									<p>PHP {{$payment->discount_total}}</p>
									<p>PHP {{$payment->service_total}}</p>
									<p>PHP {{$payment->payment_amount}}</p>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table class="guidelines-table pt-5">
				<tr class="text-sm">
					<th class="guidelines-head text-left">Travel Guides / Reminders</th>
				</tr>
				<tr class="text-xs">
					<td class="tables-data">
						<p>1. <span class="font-bold">Early Arrival: </span>Passengers are advised to arrive at the port at least one hour before the scheduled departure time to ensure a smooth boarding process.
						</p>
						<p>2. <span class="font-bold">Health and Safety Protocols: </span>It is the responsibility of passengers to familiarize themselves with the health and safety protocols of their destinations. The carrier shall not be held liable for denied entry due to non-compliance with destination documentation and health requirements.
						</p>
						<p>3. <span class="font-bold">On-board Etiquette: </span>While on board, passengers are kindly requested to adhere to the rules and regulations in place for a safe and enjoyable journey.</p>
						<p>4. <span class="font-bold">Prohibition of Gambling: </span>Please note that gambling is strictly prohibited on board the vessel. Your cooperation is appreciated.</p>
						<p>5. <span class="font-bold">Discount Eligibility: </span>Discounts are applicable to Senior Citizens, Students, and Persons with Disabilities (PWD). Passengers must present or upload a valid ID as proof of eligibility when availing of these discounts. Please note that discounts cannot be applied when a promotional fare is already in effect.</p>
					</td>
				</tr>
			</table>
		</div>
		@endforeach
	</body>
</html>