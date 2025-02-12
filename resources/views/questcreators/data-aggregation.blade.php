@extends('layouts.app')

@section('title', 'Data Aggregation')

@section('content')
    <div class="container-fluid">
        <h3>Quest Data Overview</h3>
        <h4 class="mark-information-title">Mark Information</h4>
        <div class="mark-information-container">
            <img src="{{ asset('images/ornament_star_gold.png') }}" alt="star" class="information-mark">
            <span class="fs-5">Star Rating</span><br>
            <img src="{{ asset('images/flag_02_red.png') }}" alt="flag-red" class="information-mark">
            <span class="fs-5">The total number of learners who changed the status to “watch later”</span><br>
            <img src="{{ asset('images/tsurugi_bronze_red.png') }}" alt="sword-red" class="information-mark">
            <span class="fs-5">The total number of learners who changed the status to “in progress”</span><br>
            <img src="{{ asset('images/treasure_green_gold.png') }}" alt="treasure-green" class="information-mark">
            <span class="fs-5">The total number of learners who changed the status to “completed”</span><br>
            <img src="{{ asset('images/tatefuda_yajirushi_01_brown.png') }}" alt="kanban" class="information-mark">
            <span class="fs-5">Go to the quest page (You can check user's review)</span><br>
        </div>

        <div class="background-paper-container">
            <div class="overlay-content">
                <h4 class="your-quest-title">Your Quest</h4>
                <div class="overflow-container">
                    <table class="quest-table align-middle">
                        <thead class="border text-uppercase">
                            <tr>
                                <th>Thumbnail</th>
                                <th>Title</th>
                                <th><img src="{{ asset('images/ornament_star_gold.png') }}" alt="star" class="information-mark"> Rating</th>
                                <th><img src="{{ asset('images/flag_02_red.png') }}" alt="flag-red" class="information-mark"> Watch later</th>
                                <th><img src="{{ asset('images/tsurugi_bronze_red.png') }}" alt="sword-red" class="information-mark"> in progress</th>
                                <th><img src="{{ asset('images/treasure_green_gold.png') }}" alt="treasure-green" class="information-mark"> completed</th>
                                <th>Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($quests as $quest)
                                <tr>
                                    <td class="quest-thumbnail text-center">
                                        <img src="{{ $quest->thumbnail }}" alt="Quest Thumbnail" class="thumbnail-img">
                                    </td>
                                    <td class="quest-title text-center">{{ $quest->quest_title }}</td>
                                    <td class="quest-rating text-center">{{ $quest->averageRating }}</td>
                                    <td class="quest-rating text-center">N/A</td>
                                    <td class="quest-rating text-center">N/A</td>
                                    <td class="quest-rating text-center">N/A</td>
                                    <td class="quest-link text-center">
                                        <a href="#"><img src="{{ asset('images/tatefuda_yajirushi_01_brown.png') }}" alt="kanban" class="information-mark"></a>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    <div class="pagination-container">
                        {{ $quests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    h3 {
        text-align: center;
        padding: 40px 30px;
    }

    .mark-information-title{
        margin-left: 120px;
        padding-bottom: 20px;
    }

    .mark-information-container {
        margin-right: 120px;
        margin-left: 120px;
        padding-bottom: 20px;
    }

    .information-mark {
        height: 20px;
        width: 20px;
        margin-bottom: 5px;
    }


    .background-paper-container {
        position: relative;
        width: 100%;
        max-width: 1100px;
        height: auto;
        margin: 20px auto;
        background: url('{{ asset('images/background-paper.png') }}') no-repeat center;
        background-size: cover;
        padding: 40px;
        border-radius: 10px;
    }

    .overlay-content {
        text-align: center;
        color: black;
        font-size: 24px;
    }

    .overflow-container {
        width: 100%;
        overflow-x: auto;
    }

    .your-quest-title{
        padding-bottom: 20px;
    }

    .quest-table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid black;
        border-radius: 8px;
        table-layout: fixed;
    }

    .quest-table th{
        height: 20px;
        padding: 5px;
        text-align: center;
        font-size: 16px;
        background-color: #261C11;
        color: white;
        border: 1px solid white;
    }

    .quest-table td {
        border: 1px solid #261C11;
    }

    .quest-table th:nth-child(1), .quest-table td:nth-child(1) {
        width: 150px;
    }

    .quest-table th:nth-child(2), .quest-table td:nth-child(2) {
        width: 300px;
    }

    .quest-table th:nth-child(3), .quest-table td:nth-child(3) {
        width: 100px;
    }

    .quest-table th:nth-child(4), .quest-table td:nth-child(4) {
        width: 120px;
    }

    .quest-table tr{
        letter-spacing: 2px;
    }

    .thumbnail-img {
        max-width: 100px;
        height: auto;
    }

    .pagination-container {
    background: none !important;
}

    .pagination {
        display: inline-block;
        padding: 5px;
        border-radius: 5px;
        background: #f8f8f8; /* 背景色を薄いグレーに */
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
    }

    .pagination li {
        display: inline;
        margin: 0 5px; /* 各ボタンの間隔 */
    }

    .pagination li a {
        padding: 5px 10px;
        text-decoration: none;
        border: 1px solid #ddd;
        color: #333;
        background: #fff;
        border-radius: 3px;
    }

    .pagination li a:hover {
        background: #007bff;
        color: #fff;
    }

    .pagination .active span {
        padding: 5px 10px;
        background: #007bff;
        color: #fff;
        border-radius: 3px;
    }

    .pagination-container img {
    display: none;
}


</style>