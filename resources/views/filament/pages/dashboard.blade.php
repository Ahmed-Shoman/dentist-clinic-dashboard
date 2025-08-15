<x-filament::page>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($this->getWidgets() as $widget)
            <div>
                {{ $widget }}
            </div>
        @endforeach
    </div>
</x-filament::page>
