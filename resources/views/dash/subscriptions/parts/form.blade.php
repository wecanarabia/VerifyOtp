                                    @isset($subscription)
                                        <input type="hidden" name="id" value="{{ $subscription->id }}">
                                    @endisset
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold">@lang('views.NUMBER OF DIGITS')<span class="text-danger">*</span></label>
                                            <input type="number" min="4" max="6" name="number_of_digits" value="{{ old('number_of_digits',isset($subscription)?$subscription->number_of_digits:'') }}"
                                                class="form-control">
                                            @error('number_of_digits')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold">@lang('views.NUMBER OF MINUTES')<span class="text-danger">*</span></label>
                                            <input type="number" min="1" max="10" name="number_of_minutes" value="{{ old('number_of_minutes',isset($subscription)?$subscription->number_of_minutes:'') }}"
                                                class="form-control">
                                            @error('number_of_minutes')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold">@lang('views.APP')</label>
                                            <input type="text" name="app_name" value="{{ old('app_name',isset($subscription)?$subscription->app_name:'') }}"
                                                class="form-control">
                                            @error('app_name')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
