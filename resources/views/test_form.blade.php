<!-- resources/views/test_form.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Address Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="max-w-md mx-auto mt-10">
        <form action="{{ route('checkout.store_address') }}" method="POST" class="bg-white p-6 rounded-lg shadow">
            @csrf
            <h2 class="text-lg font-bold mb-4">Test Address Form</h2>

            <div class="mb-4">
                <label for="A_name" class="block text-sm font-medium text-gray-700">Your Name</label>
                <input type="text" id="A_name" name="A_name" class="mt-1 block w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <div class="mb-4">
                <label for="A_address_line1" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" id="A_address_line1" name="A_address_line1" class="mt-1 block w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <div class="mb-4">
                <label for="A_city" class="block text-sm font-medium text-gray-700">City</label>
                <input type="text" id="A_city" name="A_city" class="mt-1 block w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <div class="mb-4">
                <label for="A_state" class="block text-sm font-medium text-gray-700">State</label>
                <input type="text" id="A_state" name="A_state" class="mt-1 block w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <div class="mb-4">
                <label for="A_postal_code" class="block text-sm font-medium text-gray-700">Postal Code</label>
                <input type="text" id="A_postal_code" name="A_postal_code" class="mt-1 block w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <div class="mb-4">
                <label for="A_country" class="block text-sm font-medium text-gray-700">Country</label>
                <input type="text" id="A_country" name="A_country" class="mt-1 block w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <div class="mb-4">
                <label for="A_phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="tel" id="A_phone_number" name="A_phone_number" class="mt-1 block w-full border border-gray-300 rounded-lg p-2" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 rounded-lg">Submit Address</button>
        </form>
    </div>
</body>
</html>
