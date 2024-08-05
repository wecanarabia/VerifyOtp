<x-front-layouts.app>
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="text-center mb-n5 float-end mx-2">
                        <img src="{{ asset('dist/images/breadcrumb/ChatBc.png') }}" alt="" class="img-fluid mb-n4">
                    </div>

                    <h4 class="fw-semibold mb-8">@lang('views.SUBSCRIPTIONS')</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted"
                                    href="{{ route('dash.dashboard') }}">@lang('views.DASHBOARD')</a></li>
                            <li class="breadcrumb-item" aria-current="page">@lang('views.SUBSCRIPTIONS')</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>
    </div>

    <!-- --------------------- start Contact ---------------- -->
    <div class="card-body">

        <div class="row">
            <div class="col-12">
                <!-- ---------------------
                            start Scroll - Horizontal
                        ---------------- -->
                <div class="card">
                    <div class="card-body">
                        <x-front-layouts.messages />
                        <div class="mb-2">
                            <h5 class="mb-0">@lang('views.SUBSCRIPTIONS')</h5>
                        </div>
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
                                        <th>@lang('views.NUMBER OF MESSAGES SENT')</th>
                                        <th>@lang('views.ACTIONS')</th>

                                    </tr>
                                    <!-- end row -->
                                </thead>
                                <tbody>
                                    @foreach ($data as $subscription)
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
    <!-- Modal -->
    {{-- <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">@lang('views.DELETE CONFIRMATION')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('dash.subscriptions.destroy', 'test') }}" method="post">
                    {{ method_field('delete') }}
                    @csrf
                    <div class="modal-body">
                        <p>@lang('views.SUBSCRIPTION DELETE CONFIRM')</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="name" id="name" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            aria-label="Close">@lang('views.CANCEL')</button>
                        <button type="submit" class="btn btn-danger">@lang('views.CONFIRM')</button>
                    </div>
            </div>
            </form>
        </div>
    </div> --}}
    </div>

    {{-- @push('javasc')
        <script>
            $('#deleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var name = button.data('info')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #name').val(name);
            })
        </script>
    @endpush --}}

</x-front-layouts.app>
