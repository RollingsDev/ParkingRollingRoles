<x-layout-default>
    <div class="container-fluid">
        <div class="row">
            <x-layout-config-menu>
            </x-layout-config-menu>
        </div>
        <div class="row">
            <div class="mt-5 ml-5">
                {{ $slot }}
            </div>
        </div>
    </div>
</x-layout-default>