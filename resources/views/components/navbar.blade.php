<ul style="list-style: none" class="m-0 p-0">
    <li class="mt-4 mb-4">
        <h2 class="text-center">
            <a href="/">
                Parking
            </a>
        </h2>
    </li>
    <li>
        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Vagas
        </button>
        <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="{{ route('floor/floor', ['floor' => 1]) }}">1 Andar</a></li>
            <li><a class="dropdown-item" href="{{ route('floor/floor', ['floor' => 2]) }}">2 Andar</a></li>
            <li><a class="dropdown-item" href="{{ route('floor/floor', ['floor' => 3]) }}">3 Andar</a></li>
        </ul>
    </li>
    <li>
        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Relatórios
        </button>
        <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="#">Controle de Fluxo</a></li>
            <li><a class="dropdown-item" href="#">Rendimento</a></li>
            <li><a class="dropdown-item" href="#">Comparação</a></li>
            <li><a class="dropdown-item" href="#">Financeiro</a></li>
            <li><a class="dropdown-item" href="#">Histórico de Valores</a></li>
        </ul>
    </li>
    <li>
        <button class="btn btn-dark">
            Fluxo
        </button>
    </li>
    <li>
        <button class="btn btn-dark">Rentabilidade</button>
    </li>
    <li>
        <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="/config">Configurações</a>
    </li>
</ul>