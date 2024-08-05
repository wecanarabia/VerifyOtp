<x-front-layouts.app>
    <div class="row">

        <div class="col-lg-12">
            <div class="card bg-light-info shadow-none position-relative overflow-hidden">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">@lang('views.PROFILE')</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a class="text-muted"
                                            href="{{ route('dash.dashboard') }}">@lang('views.DASHBOARD')</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-content searchable-container list">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-account" role="tabpanel"
                                aria-labelledby="pills-account-tab" tabindex="0">
                                <div class="row">

                                    <div id="profile-data" class="col-lg-12">

                                        <div class="chat-list chat active-chat" data-user-id="1">

                                            <div
                                                class="hstack align-items-start mb-7 pb-1 align-items-center justify-content-between">
                                                <div class="d-flex align-items-center gap-3">

                                                    <img src="{{ asset('dist\images\profile\user-1.jpg') }}"
                                                        alt="user4" width="72" height="72"
                                                        class="rounded-circle">


                                                    <div>
                                                        <h6 class="fw-semibold fs-4 mb-0">
                                                            {{ $user->name }}</h6>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-6 mb-7">
                                                    <p class="mb-1 fs-2">@lang('views.PHONE NUMBER')</p>
                                                    <h6 class="fw-semibold mb-0">{{ $user->phone }}</h6>
                                                </div>
                                                <div class="col-6 mb-7">
                                                    <p class="mb-1 fs-2">@lang('views.EMAIL')</p>
                                                    <h6 class="fw-semibold mb-0">{{ $user->email }}</h6>
                                                </div>
                                                <div class="col-6 mb-7">
                                                    <p class="mb-1 fs-2">@lang('views.PROFILE STATUS')</p>
                                                    <h6 class="fw-semibold mb-0">
                                                        {{ $user->active == 1 ? __('views.ACTIVE') : __('views.IN ACTIVE') }}
                                                    </h6>
                                                </div>

                                                <div class="col-12 mb-7">
                                                    <p class="mb-1 fs-2">@lang('views.WECAN ID')</p>
                                                    <h6 class="fw-semibold mb-0">{{ $user->wecan_id }}</h6>
                                                </div>




                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    @lang('views.CURRENT SUBSCRIPTIONS')
                      <div class="table-responsive">
                            <table id="scroll_hor" class="table border table-striped table-bordered display nowrap"
                                style="width: 100%">
                                <thead>
                                    <!-- start row -->
                                    <tr>
                                        <th>@lang('views.START DATE')</th>
                                        <th>@lang('views.END DATE')</th>
                                        <th>@lang('views.APP')</th>
                                        <th>@lang('views.SUBSCRIPTION ID')</th>
                                        <th>@lang('views.NUMBER OF MESSAGES')</th>
                                        <th>@lang('views.NUMBER OF MESSAGES SENT')</th>
                                        <th>@lang('views.ACTIONS')</th>

                                    </tr>
                                    <!-- end row -->
                                </thead>
                                <tbody>
                                    @foreach ($user->currentSubscriptions as $subscription)
                                        <tr>

                                            <td>
                                                {{ $subscription->start_date }}
                                            </td>
                                            <td>
                                                {{ $subscription->end_date }}
                                            </td>
                                            <td>
                                                {{ $subscription->app_name }}
                                            </td>
                                            <td>
                                                {{ $subscription->app_id }}
                                            </td>
                                            <td>
                                                {{ $subscription->number_of_messages }}
                                            </td>
                                           <td>
                                                {{ $subscription->number_of_messages_sent }}
                                            </td>


                                            <td>
                                                <div class="action-btn">
                                                    <a href="{{ route('dash.subscriptions.show', $subscription->id) }}"
                                                        class="text-info edit">
                                                        <i class="ti ti-eye fs-5"></i>
                                                    </a>

                                                    <a href="{{ route('dash.subscriptions.edit', $subscription->id) }}"
                                                        class="text-info edit">
                                                        <i class="ti ti-edit fs-5"></i>
                                                    </a>


                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <!-- start row -->


                            </table>
                        </div>
                </div>
            </div>
</x-front-layouts.app>
