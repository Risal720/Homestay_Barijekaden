<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barijekaden Homestay's</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
      body{
        padding-top: 4rem;
      }
    </style>
</head>
<body class="h-full">
    <!--
    This example requires updating your template:
    ```
    <html class="h-full bg-gray-100">
    <body class="h-full">```-->
    <div class="min-h-full">
      <x-navbar></x-navbar>


    
    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <!-- Your content -->
        {{ $slot }}
      </div>
    </main>
  </div>
  
</body>
</html>