<x-layout.default>
    @if (session()->has('message'))
    <div class="flex items-center p-3.5 rounded text-success bg-success-light dark:bg-success-dark-light mb-2">
        <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">
        </strong>{{ session()->get('message') }}</span>
        <button type="button" class="ltr:ml-auto rtl:mr-auto hover:opacity-80">
            <svg xmlns="" width="24px" height="24px" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" class="w-5 h-5">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>
    @endif
    <div class="panel lg:row-span-3">
        <div class="flex items-center justify-between mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Settings</h5>
        </div>
        <form class="space-y-5" action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                <label for="logo">Logo</label>
                <input id="logo" type="file" class="form-input text-base" name="logo" />
                @if (!is_null($settings['logo']))
                    <img class="w-20" src="{{ asset('storage/settings/logo/' . $settings['logo']) }}" alt="image" />
                @endif
            </div>
            <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                <label for="minimum_steps">Minimum Steps For Rewards </label>
                <input id="minimum_steps" type="text" placeholder="" name="minimum_steps"
                    class="form-input text-base"
                    value="{{ !empty($settings['minimum_steps']) ? $settings['minimum_steps'] : '' }}" />
            </div>
            <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                <label for="step_rewards">Step Rewards On Min Step</label>
                <input id="step_rewards" type="text" placeholder="" name="step_rewards" class="form-input text-base"
                    value="{{ !empty($settings['step_rewards']) ? $settings['step_rewards'] : '' }}" />
            </div>
            <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                <label for="first_level_commission">First Level Commission</label>
                <input id="first_level_commission" type="text" placeholder="" name="first_level_commission"
                    class="form-input text-base"
                    value="{{ !empty($settings['first_level_commission']) ? $settings['first_level_commission'] : '' }}" />
            </div>
            <div class="sm:flex justify-between items-center gap-5 md:gap-20">
                <label for="second_level_commission">Second Level Commission</label>
                <input id="second_level_commission" type="text" placeholder="" name="second_level_commission"
                    class="form-input text-base"
                    value="{{ !empty($settings['second_level_commission']) ? $settings['second_level_commission'] : '' }}" />
            </div>
            <button type="submit" value="submit" class="btn btn-primary !mt-6">Submit</button>
        </form>
    </div>

</x-layout.default>
