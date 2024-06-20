<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="ie=edge" http-equiv="X-UA-Compatible">
	<title>Prescription PDF</title>

	<style>
        * {
            font-size: 18px;
            font-family: sans-serif;
        }
        .wrapper {
            height: 100vh;
            width: 100%;
        }
        .rx-logo {
            font-size: 25px;
            font-weight: bold;
            padding: 1rem 0;
            font-style: italic;
        }
        header {
            text-align: center;
            border-bottom: 1px solid black;
            padding: 10px 0;
        }
        header h1 {
            font-size: 25px;
        }
        header p {
            font-size: 18px;
        }
        main {
            position: relative;
            max-width: 90%;
            margin: 0 auto;
            padding: 1rem 0;
        }

        main .date {
            position: absolute;
            right: 0;
            padding: 5px 0;
        }
        main .patient-info > *{
            padding: 5px 0;
        }
        main .prescription-list {
            padding-bottom: 1.5rem;
        }
        main .prescription-list .quantity, main .prescription-list .dosage {
            margin-left: 20px;
        }
        main .prescription-list .quantity {
            margin-top: 5px;
            margin-bottom: 5px;
        }
        .line {
            border: .5px solid black;
            width: 150%;
            margin-left: -2rem;
            margin-bottom: 5px;
        }
        footer {
            max-width: 90%;
            margin: 0 auto;
            text-align: center
        }
        footer .footer-container {
            position: relative;
            margin-top: 5rem;
        }
        footer .footer-container .footer {
            position: absolute;
            right: 0
        }
	</style>
</head>

<body>
	<div class="wrapper">
		<div>
			<header>
				<h1>FILARCA-RABENA-CORPUZ DENTAL <br>CLINIC AND DENTAL SUPPLY</h1>
				<p>113 Salcedo Street, City of Vigan, Philippines</p>
			</header>
			<main>
				<div class="date">
					<div>Date: {{ date('F d, Y', strtotime(date('Y-m-d'))) }}</div>
				</div>
				<div class="patient-info">
					<div>Patient Name: {{ $prescription->patient->user->full_name }}</div>
					<div>Address: {{ $prescription->patient->user->address }}</div>
					<div>Age: {{ $prescription->patient->age }}</div>
				</div>
				<div>
					<div class="rx-logo">
						Rx
					</div>
					<div>
						@foreach ($prescription->medicines as $index => $medicine)
							<div class="prescription-list">
								<div>{{ $index + 1 }}) {{ $medicine }}</div>
								<div class="quantity">Quantity(pcs): {{ $prescription->quantities[$index] }}</div>
								<div class="dosage">Dosage: {{ $prescription->dosages[$index] }}</div>
							</div>
						@endforeach
					</div>
				</div>
			</main>

		</div>
		<footer>
			<div class="footer-container">
				<div class="footer">
					<div class="line"></div>
					<div>{{ auth()->user()->full_name }}</div>
				</div>
			</div>
		</footer>
	</div>
</body>

</html>
