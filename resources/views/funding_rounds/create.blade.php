<!DOCTYPE html>
<html>
<head>
    <title>Create Funding Round</title>
</head>
<body>
    <h1>Create Funding Round</h1>

    <form method="POST" action="{{ route('funding_rounds.store') }}">
        @csrf

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        @error('name')
            <p>{{ $message }}</p>
        @enderror

        <label for="target">Target:</label>
        <input type="number" id="target" name="target">
        @error('target')
            <p>{{ $message }}</p>
        @enderror

        <label for="announced_date">Announced Date:</label>
        <input type="date" id="announced_date" name="announced_date">
        @error('announced_date')
            <p>{{ $message }}</p>
        @enderror

        <label for="money_raised">Money Raised:</label>
        <input type="number" id="money_raised" name="money_raised">
        @error('money_raised')
            <p>{{ $message }}</p>
        @enderror

        <label for="lead_investor">Lead Investor:</label>
        <input type="text" id="lead_investor" name="lead_investor">
        @error('lead_investor')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">Create</button>
    </form>
</body>
</html>
