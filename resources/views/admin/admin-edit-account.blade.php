@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <!-- ヘッダー部分 -->
        <div class="card-header text-center">
            <a href="{{ route('admin.index') }}" class="btn btn-warning mb-3" style="width: 200px;">
                Edit Account
            </a>
        </div>

        <!-- 検索・フィルター部分 -->
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="sortOrder">
                        <option value="asc">Name order (ascending)</option>
                        <option value="desc">Name order (descending)</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <!-- ユーザータイプ切り替えボタン -->
                    <button class="btn btn-secondary me-2" id="learnerBtn">Learner</button>
                    <button class="btn btn-secondary" id="creatorBtn">Course Writer</button>
                </div>
            </div>

            <!-- ユーザーリスト表示部分 -->
            <div class="user-lists mt-4">
                <!-- Learner リスト -->
                <div id="learnerList" class="d-none">
                    <h3>Learners</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Profile Image</th>
                                    <th>Name</th>
                                    <th>Violation of rules</th>
                                    <th>Created At</th>
                                    <th>Last Sign-In</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <img src="{{ $user->profile_image ?? asset('images/default-user.png') }}" 
                                                 alt="Profile" class="rounded-circle" 
                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                        </td>
                                        <td>
                                            {{-- TODO: route('learner.profile', $user->id) に変更してください --}}
                                            <a href="#" class="text-decoration-none">
                                                {{ $user->player_nickname }} 
                                                <br>
                                                <small>({{ $user->first_name }} {{ $user->family_name }})</small>
                                            </a>
                                        </td>
                                        <td>{{ $user->violation_count ?? 0 }}</td>
                                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $user->last_login_at ?? 'Never' }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning">Violation Warning</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Course Writer リスト -->
                <div id="creatorList" class="d-none">
                    <h3>Course Writers</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Profile Image</th>
                                    <th>Name</th>
                                    <th>Violation of rules</th>
                                    <th>Created At</th>
                                    <th>Last Sign-In</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($creators as $creator)
                                    <tr>
                                        <td>
                                            <img src="{{ $creator->creator_image ?? asset('images/default-creator.png') }}" 
                                                 alt="Profile" class="rounded-circle" 
                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                        </td>
                                        <td>
                                            {{-- TODO: route('creator.profile', $creator->id) に変更してください --}}
                                            <a href="#" class="text-decoration-none">
                                                {{ $creator->creator_name }}
                                            </a>
                                        </td>
                                        <td>{{ $creator->violation_count ?? 0 }}</td>
                                        <td>{{ $creator->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $creator->user->last_login_at ?? 'Never' }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning">Violation Warning</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const learnerBtn = document.getElementById('learnerBtn');
    const creatorBtn = document.getElementById('creatorBtn');
    const learnerList = document.getElementById('learnerList');
    const creatorList = document.getElementById('creatorList');
    const sortOrder = document.getElementById('sortOrder');
    const searchInput = document.getElementById('searchInput');

    // Learnerボタンのトグル処理
    learnerBtn.addEventListener('click', function() {
        this.classList.toggle('btn-warning');
        this.classList.toggle('btn-secondary');
        learnerList.classList.toggle('d-none');
        updateSort();
    });

    // Course Writerボタンのトグル処理
    creatorBtn.addEventListener('click', function() {
        this.classList.toggle('btn-warning');
        this.classList.toggle('btn-secondary');
        creatorList.classList.toggle('d-none');
        updateSort();
    });

    // ソート順変更時の処理
    sortOrder.addEventListener('change', updateSort);

    // 検索機能
    searchInput.addEventListener('input', function() {
        const searchText = this.value.toLowerCase();
        filterTable(searchText);
    });

    function updateSort() {
        const order = sortOrder.value;
        sortTables(order);
    }

    function sortTables(order) {
        sortTable(learnerList.querySelector('table'), order);
        sortTable(creatorList.querySelector('table'), order);
    }

    function sortTable(table, order) {
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));

        rows.sort((a, b) => {
            const textA = a.cells[0].textContent.toLowerCase();
            const textB = b.cells[0].textContent.toLowerCase();
            return order === 'asc' ? 
                textA.localeCompare(textB) : 
                textB.localeCompare(textA);
        });

        rows.forEach(row => tbody.appendChild(row));
    }

    function filterTable(searchText) {
        const tables = document.querySelectorAll('.table');
        tables.forEach(table => {
            const rows = table.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchText) ? '' : 'none';
            });
        });
    }
});
</script>
@endsection
