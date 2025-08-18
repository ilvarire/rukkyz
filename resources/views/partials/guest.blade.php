<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="{{ url('/favicon.svg')}}" sizes="any">
<link rel="icon" href="{{ url('/favicon.svg')}}" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<!-- Meta -->
<meta name="keywords"
    content="Rukkyz, rukkyzkitchen, nigerian food, buy nigerian food uk, nigerian food uk, nigerian food luton, African food,">
<meta name="description"
    content="Rukkyz kitchen is an innovative culinary venture offering a blend of traditional and modern take on African cuisine. With vibrant rich flavours and spice, each dish takes you on a journey through the heart of Africa one bite at a time">
<meta property="og:title" content="Rukkyz kitchen - Authentic Nigerian Food Delivered Across the UK">
<meta property="og:description"
    content="Craving Nigerian cuisine in luton or any part of the Uk? Order fresh, delicious Nigerian meals from rukkyzkitchen – delivered hot and fast anywhere in the UK.">
<meta property="og:image" content="{{ url('images/edi1.png')}}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Rukkyzkitchen">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    x-cloak: {
        display: none !important;
    }
</style>
@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance