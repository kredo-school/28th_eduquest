@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <!-- Admin title -->
                    <div class="text-center mb-4" style="font-family: 'DotGothic16', sans-serif; font-weight: bold;">
                        Admin
                    </div>

                    <div class="row g-4">
                        <!-- Edit badge -->
                        <div class="col-md-6">
                            <a href="#" class="text-decoration-none text-dark">
                                <div class="border rounded p-3 text-center" style="font-family: 'DotGothic16', sans-serif; font-weight: bold;">
                                    Edit badge
                                </div>
                            </a>
                        </div>

                        <!-- Edit course category -->
                        <div class="col-md-6">
                            <a href="#" class="text-decoration-none text-dark">
                                <div class="border rounded p-3 text-center" style="font-family: 'DotGothic16', sans-serif; font-weight: bold;">
                                    Edit course category
                                </div>
                            </a>
                        </div>

                        <!-- Edit course or review -->
                        <div class="col-md-6">
                            <a href="#" class="text-decoration-none text-dark">
                                <div class="border rounded p-3 text-center" style="font-family: 'DotGothic16', sans-serif; font-weight: bold;">
                                    Edit course or review
                                </div>
                            </a>
                        </div>

                        <!-- Edit account -->
                        <div class="col-md-6">
                            <a href="{{ route('admin.edit.account') }}" class="text-decoration-none text-dark">
                                <div class="border rounded p-3 text-center" style="font-family: 'DotGothic16', sans-serif; font-weight: bold;">
                                    Edit Account
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection