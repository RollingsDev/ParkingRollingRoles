<x-layout-default>
    <div style="margin-left:200px" class="fixed-top">
        <h4 class="title mt-4">{{ $aResponse['floor'] }}</h4>
        @foreach ($aResponse['vacancy'] as $key => $value)
            
            @if ($key == 0)
                <div class="row">
            @endif

            <div class="col">
                <div class="l-c">
                    Vaga {{ $value['number'] }}
                </div>
            </div>

            @if (($key + 1) == $aResponse['line'])
                </div>
                <div class="row">
            @endif

            @if ($aResponse['diff'] > 0 && ($aResponse['total'] == $key + 1))
                @for ($i = 1; $i <= $aResponse['diff']; $i++)
                <div class="col"></div>
                @endfor
            @endif

        @endforeach
        
    </div>
</x-layout-default>