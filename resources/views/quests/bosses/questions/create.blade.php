@extends('layouts.app')

@section('title', 'Setting the questions')

@section('content')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-7">
            <h2 class="mb-4">Add Questions</h2>

            <form method="POST" action="{{ route('quests.bosses.questions.store', ['quest_id' => $quest_id, 'boss_id' => $boss_id]) }}">
                @csrf
                <div id="question-container">
                    <div class="question-item">
                        <div class="mb-3">
                            <label class="form-label">Question</label>
                            <input type="text" name="questions[0][question_text]" class="form-control" required>
                        </div>
                    </div>
                </div>
                <!-- 選択肢入力 (4つ) -->
                <h3>Options</h3>
                    <div id="option-container">
                        @for ($i = 0; $i < 4; $i++)
                            <div class="option-item mb-3">
                                <label class="form-label">Option {{ $i + 1 }}</label>
                                <input type="text" name="questions[0][options][{{ $i }}][option_text]" class="form-control" required>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="questions[0][correct_option]" value="{{ $i }}" required>
                                    <label class="form-check-label">Correct Answer</label>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div id="question-container">
                        <div class="question-item">
                            <div class="mb-3">
                                <label class="form-label">Points</label>
                                <input type="number" name="questions[0][points]" class="form-control" required>
                            </div>
                        </div>
                    </div>
                <button type="button" id="add-question" class="btn btn-secondary mt-3">Add Question</button>
                <button type="submit" class="btn btn-primary mt-3">Save Questions</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let questionIndex = 1;
    
        document.getElementById("add-question").addEventListener("click", function() {
            const container = document.getElementById("question-container");
            const newQuestion = document.createElement("div");
            newQuestion.classList.add("question-item");
    
            newQuestion.innerHTML = `
                <div class="mb-3">
                    <label class="form-label">Question</label>
                    <input type="text" name="questions[\${questionIndex}][question_text]" class="form-control" required>
                </div>
    
                <h3>Options</h3>
                <div id="option-container">
                    ${Array.from({ length: 4 }).map((_, i) => `
                        <div class="option-item mb-3">
                            <label class="form-label">Option ${i + 1}</label>
                            <input type="text" name="questions[\${questionIndex}][options][${i}][option_text]" class="form-control" required>
    
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="questions[\${questionIndex}][correct_option]" value="${i}" required>
                                <label class="form-check-label">Correct Answer</label>
                            </div>
                        </div>
                    `).join('')}
                </div>

                <div class="mb-3">
                    <label class="form-label">Points</label>
                    <input type="number" name="questions[\${questionIndex}][points]" class="form-control" required>
                </div>
            `;
            container.appendChild(newQuestion);
            questionIndex++;
        });
    });
    </script>
@endsection
