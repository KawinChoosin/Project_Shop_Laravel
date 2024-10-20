<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @include('components.nav')

        <!-- profile zone -->
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Profile Information</h1>
            @if($customer)
                <div>
                    <h2 class="text-xl">Customer ID: {{ $customer->C_id }}</h2>
                    <p>Name: {{ $customer->C_name }}</p>
                    <p>Email: {{ $customer->C_email }}</p>
                    <p>Gender: {{ $customer->C_gender }}</p>
                    <p>Age: {{ $customer->C_age }}</p>
                </div>
            @else
                <p>No customer information found.</p>
            @endif
        </div>

        @include('components.footer')
    </body>
</html>