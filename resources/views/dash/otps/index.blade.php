<x-front-layouts.app>
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="text-center mb-n5 float-end mx-2">
                        <img src="{{ asset('dist/images/breadcrumb/ChatBc.png') }}" alt="" class="img-fluid mb-n4">
                    </div>

                    <h4 class="fw-semibold mb-8">@lang('views.OTPS')</h4>
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

    <!-- --------------------- start Contact ---------------- -->
        <div class="card-body">
        <div class="row">
            <div class=" offset-10">
                <div class="row">
                    <div class="col-8">
                        <form action="" method="get">
                            <div class="row">
                                <div class="col-8">
                                    <input type="date" name="date" class="form-control"
                                        value="{{ old('date', date('Y-m-d')) }}" class="form-control">
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-success">@lang('views.SEARCH')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-12">
                <!-- ---------------------
                            start Scroll - Horizontal
                        ---------------- -->
                <div class="card">
                    <div class="card-body">
                        <x-front-layouts.messages />
                        <div class="mb-2">
                            <h5 class="mb-0">@lang('views.OTPS')</h5>
                        </div>
                        <div class="table-responsive">
                            <table id="scroll_hor" class="table border table-striped table-bordered display nowrap"
                                style="width: 100%">
                                <thead>
                                    <!-- start row -->
                                    <tr>
                                        <th>@lang('views.CREATED AT')</th>
                                        <th>@lang('views.APP')</th>
                                        <th>@lang('views.SUBSCRIPTION ID')</th>
                                        <th>@lang('views.OTP')</th>
                                        <th>@lang('views.EXPIRATION TIME')</th>
                                        <th>@lang('views.STATUS')</th>

                                    </tr>
                                    <!-- end row -->
                                </thead>
                                <tbody>
                                    @foreach ($data as $otp)
                                        <tr>

                                            <td>
                                                {{ $otp->created_at }}
                                            </td>
                                            <td>
                                                {{ $otp?->subscription?->app_name }}
                                            </td>
                                            <td>
                                                {{ $otp?->subscription?->app_id }}
                                            </td>
                                            <td>
                                                {{ $otp->otp }}
                                            </td>
                                             <td>
                                                {{ $otp->expires_at }}
                                            </td>
                                            <td>
                                                {{ $otp->is_used?__('views.USED'):__('views.UNUSED') }}
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                                <!-- start row -->


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ---------------------
                            end Scroll - Horizontal
                        ---------------- -->
    </div>
    </div>
    </div>
    <!-- ---------------------
                        end Contact
                    ---------------- -->


    </div>

</x-front-layouts.app>
