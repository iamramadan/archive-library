<div>
    @props(['name'])
        @if ($errors->has($name))
            <p class="mt-1 text-sm text-red-600">
                {{ $errors->first($name) }}
            </p>
        @endif
</div>