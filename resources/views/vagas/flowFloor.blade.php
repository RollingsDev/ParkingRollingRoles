<x-layout-default>
    <div style="margin-left:200px" class="fixed-top">
        <h4 class="title mt-4">{{ $aResponse['floor'] }}</h4>
        <hr style="margin-right: 40px">
        @foreach ($aResponse['vacancy'] as $key => $value)

            @if ($key == 0)
                <div class="row">
            @endif
            <div class="col">
                <div class="l-c {{ isset($aResponse['occupied'][$value->id]) ? 'bg-danger' : 'bg-success' }}">
                    <form action="{{ route('floor/takeThePosition') }}" method="POST">
                        @csrf
                        @method('POST')
                        <button name="vacancy_id" value="{{ $value['id'] }}" style="background: none; border:none">
                            Vaga {{ $value['number'] }} {{ isset($value->client[0]->code) ? $value->client[0]->code : '' }}
                            {{ isset($value->client[0]->formatted_arrival_date) ? $value->client[0]->formatted_arrival_date : '' }}
                        </button>
                    </form>
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