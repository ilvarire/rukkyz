<!DOCTYPE html>
<html x-bind:class="{ 'theme-dark': dark }" x-data="data()" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.admin')
</head>

<body data-mode="light" data-sidebar-size="lg" class="group">
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" x-bind:class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        @include('livewire.admin.includes.desktop-sidebar')

        <!-- Mobile sidebar -->
        @include('livewire.admin.includes.mobile-sidebar')

        <div class="flex flex-col flex-1 w-full">
            <!-- Header -->
            <livewire:admin.layout.header />

            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <script>
        $('input[name="mobile-number"]').mask('(00) 0000 0000');
        $('input[name="money"]').mask('000,000,000,000,000.00', { reverse: true });
        $('input[name="weight"]').mask('000,000,000,000,000.00', { reverse: true });
        $('input[name="coupon"]').focusout(function () {
            $('input[name="coupon"]').val(this.value.toUpperCase());
        });
    </script>
    @fluxScripts
</body>

</html>