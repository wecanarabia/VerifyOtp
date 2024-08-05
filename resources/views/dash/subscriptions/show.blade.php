<x-front-layouts.app>
    <div class="row">

        <div class="col-lg-12">
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
                    <h5 class="mb-0">@lang('views.SUBSCRIPTIONS')</h5>
                </div>
                <div class="card card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="chat-list chat active-chat" data-user-id="1">

                                        <div class="row">
                                            <div class="col-8 mb-7">
                                                <p class="mb-1 fs-2">@lang('views.START DATE')</p>
                                                <h6 class="fw-semibold mb-0">
                                                    {{ $subscription->start_date }}
                                                </h6>
                                            </div>
                                            <div class="col-8 mb-7">
                                                <p class="mb-1 fs-2">@lang('views.END DATE')</p>
                                                <h6 class="fw-semibold mb-0">
                                                    {{ $subscription->end_date }}
                                                </h6>
                                            </div>
                                            <div class="col-8 mb-7">
                                                <p class="mb-1 fs-2">@lang('views.APP')</p>
                                                <h6 class="fw-semibold mb-0">
                                                    {{ $subscription->app_name }}
                                                </h6>
                                            </div>
                                            <div class="col-8 mb-7">
                                                <p class="mb-1 fs-2">@lang('views.SUBSCRIPTION ID')</p>
                                                <h6 class="fw-semibold mb-0">
                                                    {{ $subscription->app_id }}
                                                </h6>
                                            </div>
                                            <div class="col-8 mb-7">
                                                <p class="mb-1 fs-2">@lang('views.TOKEN')</p>
                                                <h6 class="fw-semibold mb-0">
                                                    {{ $subscription->token }}
                                                </h6>
                                            </div>
                                           <div class="col-8 mb-7">
                                                <p class="mb-1 fs-2">@lang('views.NUMBER OF MESSAGES')</p>
                                                <h6 class="fw-semibold mb-0">
                                                    {{ $subscription->number_of_messages }}
                                                </h6>
                                            </div>
                                            <div class="col-8 mb-7">
                                                <p class="mb-1 fs-2">@lang('views.NUMBER OF MESSAGES SENT')</p>
                                                <h6 class="fw-semibold mb-0">
                                                    {{ $subscription->number_of_messages_sent }}
                                                </h6>
                                            </div>
                                            <div class="col-8 mb-7">
                                                <p class="mb-1 fs-2">@lang('views.NUMBER OF DIGITS')</p>
                                                <h6 class="fw-semibold mb-0">
                                                    {{ $subscription->number_of_digits }}
                                                </h6>
                                            </div>
                                             <div class="col-8 mb-7">
                                                <p class="mb-1 fs-2">@lang('views.NUMBER OF MINUTES')</p>
                                                <h6 class="fw-semibold mb-0">
                                                    {{ $subscription->number_of_minutes }}
                                                </h6>
                                            </div>
                                            <div class="col-8 mb-7">
                                                <p class="mb-1 fs-2">@lang('views.USER')</p>
                                                <h6 class="fw-semibold mb-0">
                                                    {{ $subscription?->user?->name }}
                                                </h6>
                                            </div>
                                            <div class="col-8 mb-7">
                                                <p class="mb-1 fs-2">@lang('views.TYPE')</p>
                                                <h6 class="fw-semibold mb-0">
                                                    @if ($subscription->type == 'email')
                                                        @lang('views.EMAIL')
                                                    @elseif($subscription->type == 'whatsapp')
                                                        @lang('views.WHATSAPP')
                                                    @elseif($subscription->type == 'unformal_whatsapp')
                                                        @lang('views.UNFORMAL WHATSAPP')
                                                    @endif
                                                    {{ $subscription->number_of_minutes }}
                                                </h6>
                                            </div>


                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ route('dash.subscriptions.edit', $subscription->id) }}"
                                                class="btn btn-primary fs-2">@lang('views.EDIT')</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-front-layouts.app>
