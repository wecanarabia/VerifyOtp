<x-front-layouts.app>
    <div class="row">

        <div class="col-lg-10">
            <div class="card bg-light-info shadow-none position-relative overflow-hidden">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">@lang('views.SUBSCRIPTIONS')</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a class="text-muted"
                                            href="{{ route('dash.dashboard') }}">@lang('views.DASHBOARD')</a></li>
                                    <li class="breadcrumb-item" aria-current="page"><a class="text-muted"
                                            href="{{ route('dash.subscriptions.index') }}">@lang('views.SUBSCRIPTIONS')</a></li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3">
                            <div class="text-center mb-n5">
                                <img src="{{ asset('dist/images/breadcrumb/ChatBc.png') }}" alt=""
                                    class="img-fluid mb-n4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-content searchable-container list">
                <div class="mb-2">
                    <h2 class="mb-0">@lang('views.EDIT SUBSCRIPTION')</h2>
                </div>
                <div class="card card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <form method="post" action="{{ route('dash.subscriptions.update', $subscription->id) }}">
                                        @csrf
                                        @method('put')

                                        @include('dash.subscriptions.parts.form')

                                        <input type="submit" value="@lang('views.UPDATE')" class="btn btn-primary">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-front-layouts.app>
