<x-layout-default>
    <div style="margin-left:200px;" class="fixed-top">
        <h4 class="title mt-4">Parking Rolling's</h4>
        <div class="container">
            <div class="row mt-5">
                {{-- @dd($aFloor) --}}
                @foreach ($aFloor as $floor)
                    <div class="col">
                        <div class="card border-dark mb-3" style="max-width: 18rem;">
                            <div class="card-header bg-dark text-white"><b>{{ $floor->name }}</b></div>
                            <div class="card-body text-secondary">
                            <h5 class="card-title">{{ $floor->vacancies_in ."/".$floor->vacancies_total}} de Vagas</h5>
                            <p class="card-text">{{ $floor->vacancies_perc }} de <b>Ocupação</b></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <hr style="margin-right:40px" class="mt-5 mb-5">
        <h2 class="title">Localizar</h2>
        <form class="container" action="{{ route('menu/search') }}" method="POST">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon3">Placa</span>
                            <input 
                                type="text" 
                                class="form-control input-group-sm" 
                                id="plate" 
                                name="plate"
                                value="<?= isset($_REQUEST['plate']) ? $_REQUEST['plate'] : '' ?>"
                                aria-describedby="basic-addon3 basic-addon4"
                            >
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon3">Código</span>
                            <input 
                                type="text" 
                                class="form-control input-group-sm" 
                                id="code" 
                                name="code"
                                value="<?= isset($_REQUEST['code']) ? $_REQUEST['code'] : '' ?>"
                                aria-describedby="basic-addon3 basic-addon4"
                            >
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon3">Andar</span>
                            <select 
                                type="text" 
                                class="form-control input-group-sm" 
                                id="floor_id" 
                                name="floor_id"
                                aria-describedby="basic-addon3 basic-addon4"
                            >
                                <option value="">Selecione</option>
                                @foreach ($comboFloor as $value)
                                    <option value="{{ $value->id }}" {{ isset($_REQUEST['floor_id']) && $_REQUEST['floor_id'] == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-success">Buscar</button>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @if (isset($search['error']))
                        <div class="alert alert-warning" role="alert">
                            {{ $search['error'] }}
                        </div>
                    @endif
                    @if (empty($search[0]) && $search != null && !isset($search['error']))
                        <div class="alert alert-warning" role="alert">
                            Nenhum registro encontrado
                        </div>
                    @endif
                    @if (!empty($search) && !isset($search['error']) && !empty($search[0]))
                        <table class="table table-hover mt-3 text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Placa</th>
                                    <th scope="col">Código</th>
                                    <th scope="col">Data de Entrada</th>
                                    <th scope="col">N° da Vaga</th>
                                    <th scope="col">Andar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($search as $value)
                                    <tr>
                                        <th>{{ $value->code }}</th>
                                        <th>{{ $value->plate }}</th>
                                        <td>{{ $value->arrival_date }}</td>
                                        <td>{{ $value->vacancy_number }}</td>
                                        <td>{{ $value->floor_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </form>
    </div>
</x-layout-default>