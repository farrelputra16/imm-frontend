<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invest in Funding Round</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .form-container {
            max-width: 800px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            text-align: center;
            color: #6c63ff;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .form-group label {
            font-weight: bold;
            color: #333;
        }
        .form-control {
            border: 1px solid #6c63ff;
            border-radius: 4px;
        }
        .btn-primary {
            background-color: #6c63ff;
            border-color: #6c63ff;
        }
        .btn-outline-secondary {
            border-color: #6c63ff;
            color: #6c63ff;
        }
        .btn-outline-secondary:hover {
            background-color: #6c63ff;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container form-container">
        <div class="form-title">Invest in Funding Round: {{ $fundingRound->name }}</div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('investments.storeFromFundingRound', $fundingRound->id) }}" method="POST">
            @csrf

            <div class="row mb-3">
                <!-- Investment amount -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="formatted_amount">Investment Amount</label>
                        <input type="text" name="formatted_amount" id="formatted_amount" class="form-control" required placeholder="Enter the amount you wish to invest">
                        <!-- Hidden field to store the unformatted value -->
                        <input type="hidden" name="amount" id="amount" value="">
                    </div>
                </div>

                <!-- Investment date -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="investment_date">Investment Date</label>
                        <input type="date" name="investment_date" id="investment_date" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <!-- Funding Type (fetched from related company) -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="funding_type">Funding Type</label>
                        <input type="text" name="funding_type" id="funding_type" class="form-control" value="{{ $fundingRound->company->funding_stage }}" readonly>
                    </div>
                </div>

                <!-- Investment Type -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipe_investasi">Investment Type</label>
                        <select name="tipe_investasi" id="tipe_investasi" class="form-control">
                            <option value="venture_capital">Venture Capital</option>
                            <option value="individual_angel">Individual/Angel</option>
                            <option value="private_equity_firm">Private Equity Firm</option>
                            <option value="accelerator">Accelerator</option>
                            <option value="investment_partner">Investment Partner</option>
                            <option value="corporate_venture_capital">Corporate Venture Capital</option>
                            <option value="micro_vc">Micro VC</option>
                            <option value="angel_group">Angel Group</option>
                            <option value="incubator">Incubator</option>
                            <option value="investment_bank">Investment Bank</option>
                            <option value="family_investment_office">Family Investment Office</option>
                            <option value="venture_debt">Venture Debt</option>
                            <option value="co_working_space">Co-Working Space</option>
                            <option value="fund_of_funds">Fund Of Funds</option>
                            <option value="hedge_fund">Hedge Fund</option>
                            <option value="government_office">Government Office</option>
                            <option value="university_program">University Program</option>
                            <option value="entrepreneurship_program">Entrepreneurship Program</option>
                            <option value="secondary_purchaser">Secondary Purchaser</option>
                            <option value="startup_competition">Startup Competition</option>
                            <option value="syndicate">Syndicate</option>
                            <option value="pension_funds">Pension Funds</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <!-- Pengirim (Sender) -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pengirim">Sender (Pengirim)</label>
                        <input type="text" name="pengirim" id="pengirim" class="form-control" value="{{ $firstName }}" required>
                    </div>
                </div>

                <!-- Bank Asal (Originating Bank) -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bank_asal">Originating Bank (Bank Asal)</label>
                        <input type="text" name="bank_asal" id="bank_asal" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <!-- Bank Tujuan (Destination Bank) -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bank_tujuan">Destination Bank (Bank Tujuan)</label>
                        <input type="text" name="bank_tujuan" id="bank_tujuan" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-outline-secondary me-2">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <!-- Script for formatting amount and keeping the original value -->
    <script>
        document.getElementById('formatted_amount').addEventListener('input', function (e) {
            // Remove any non-digit characters
            let value = e.target.value.replace(/\D/g, '');

            // Format the value as a currency
            e.target.value = new Intl.NumberFormat('id-ID').format(value);

            // Set the hidden input value to the raw number (no formatting)
            document.getElementById('amount').value = value;
        });
    </script>
</body>
</html>
