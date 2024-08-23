<?php
    $aSelect = isset($_REQUEST['floor_id']) ? $_REQUEST['floor_id'] : '';
?>
<x-layout-config>
    <div class="container-fluid" style="margin-left:140px">
        <div class="row mt-4">
            <h2>Config - Vagas</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-6 offset-md-3">
                <div class="d-flex justify-content-end mb-2">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Novo
                    </button>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#Id</th>
                            <th scope="col">Número</th>
                            <th scope="col">
                                <form class="input-group input-group-sm" method="GET" action="{{ route('config/vacancy.show', ['vacancy' => '0']) }}" id="vacancy-form">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Andar</span>
                                    <select name="floor_id" id="floor-select" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                        <option value="" {{ empty($aSelect) ? 'selected' : '' }}>Todos</option>
                                        @foreach ($aFloor as $floor)
                                            <option value="{{ $floor['id'] }}" {{ $aSelect == $floor['id'] ? 'selected' : '' }}>{{ $floor['name'] }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </th>
                            <th scope="col">Status</th>
                            <th scope="col" style="text-align: center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aVacancy as $value)
                        <form action="{{ route('config/vacancy.update', ['vacancy' => $value['id']]) }}" method="POST" name="form-{{ $value['id'] }}">
                            @csrf
                            @method('PATCH')
                                <tr>
                                    <th scope="row">{{ $value['id'] }}</th>
                                    <td>
                                        <input type="number" class="form-control" name="number" value="{{ $value['number'] }}">
                                    </td>
                                    <td>
                                        <select name="floor_id" class="form-control">
                                            @foreach ($aFloor as $floor)
                                                <option value="{{ $floor['id'] }}" {{ $floor['id'] == $value['floor_id'] ? 'selected' : '' }} >{{ $floor['name'] }}</option>
                                            @endforeach
                                        </select>                                    
                                    </td>
                                    <td>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ $value['status'] == '1' ? 'selected' : '' }}>Ativo</option>    
                                            <option value="0" {{ $value['status'] == '0' ? 'selected' : '' }}>Inativo</option>    
                                        </select>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-6">
                                                <button style="border: none; background-color:#fff" onclick="deleteById('config/vacancy/{{ $value['id'] }}', {{ $value['id'] }}, '{{ $value['number'] }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash text-danger" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <button style="border: none; background-color:#fff">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil text-success" viewBox="0 0 16 16">
                                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </form>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  
  <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('config/vacancy.store') }}">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Andar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Número</span>
                        <input type="number" class="form-control" name="number" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Andar</span>
                        <select name="floor_id" id="inputGroup-sizing-sm" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            <option value="" disabled selected>Selecione</option>
                            @foreach ($aFloor as $value)
                                <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Status</span>
                        <select name="status" id="inputGroup-sizing-sm" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Criar</button>
                </div>
            </form>
        </div>
    </div>
</x-layout-config>
<script>
$(document).ready(function() {
    $('#floor-select').on('change', function() {
        var floorId = $(this).val(); // Obtém o valor selecionado
        floorId = floorId > 0 ? floorId : 0

        if (floorId >= 0) {
            actionUrl = `http://127.0.0.1:8000/config/vacancy/${floorId}`
        }
        console.log(actionUrl)
        $('#vacancy-form').attr('action', actionUrl); // Atualiza o atributo action do formulário
        console.log(actionUrl)
        $('#vacancy-form').submit(); // Submete o formulário
    });

});
</script>