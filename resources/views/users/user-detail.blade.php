<x-layout.default>
    <script src="{{ asset('/assets/js/simple-datatables.js') }}"></script>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Users</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Detail</span>
            </li>
        </ul>
        <div class="pt-5">
            <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-5 mb-5">
                <div class="panel">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Profile</h5>
                        <a href="{{ route('users.edit', $user->id) }}"
                            class="ltr:ml-auto rtl:mr-auto btn btn-primary p-2 rounded-full">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns=""
                                class="w-5 h-5">
                                <path opacity="0.5" d="M4 22H20" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" />
                                <path
                                    d="M14.6296 2.92142L13.8881 3.66293L7.07106 10.4799C6.60933 10.9416 6.37846 11.1725 6.17992 11.4271C5.94571 11.7273 5.74491 12.0522 5.58107 12.396C5.44219 12.6874 5.33894 12.9972 5.13245 13.6167L4.25745 16.2417L4.04356 16.8833C3.94194 17.1882 4.02128 17.5243 4.2485 17.7515C4.47573 17.9787 4.81182 18.0581 5.11667 17.9564L5.75834 17.7426L8.38334 16.8675L8.3834 16.8675C9.00284 16.6611 9.31256 16.5578 9.60398 16.4189C9.94775 16.2551 10.2727 16.0543 10.5729 15.8201C10.8275 15.6215 11.0583 15.3907 11.5201 14.929L11.5201 14.9289L18.3371 8.11195L19.0786 7.37044C20.3071 6.14188 20.3071 4.14999 19.0786 2.92142C17.85 1.69286 15.8581 1.69286 14.6296 2.92142Z"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path opacity="0.5"
                                    d="M13.8879 3.66406C13.8879 3.66406 13.9806 5.23976 15.3709 6.63008C16.7613 8.0204 18.337 8.11308 18.337 8.11308M5.75821 17.7437L4.25732 16.2428"
                                    stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                    </div>
                    <div class="mb-5">
                        <div class="flex flex-col justify-center items-center">
                            {{-- @dd($user); --}}
                            @if (is_null($user->profile))
                                <img src="{{ asset('/assets/images/profile.jpg') }}" alt="image"
                                    class="w-24 h-24 rounded-full object-cover  mb-5" />
                            @else
                                <img src="{{ asset('/storage/images/' . $user->profile->profile_pic) }}" alt="image"
                                    class="w-24 h-24 rounded-full object-cover  mb-5" />
                            @endif
                            <p class="font-semibold text-primary text-xl">
                                {{ !empty($user->name) ? ucfirst($user->name) : '' }}</p>
                        </div>
                        <ul class="mt-5 flex flex-col max-w-[160px] m-auto space-y-4 font-semibold text-white-dark">
                            <li class="flex items-center gap-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns=""
                                    class="w-5 h-5 shrink-0">
                                    <path opacity="0.5"
                                        d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12Z"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path
                                        d="M6 8L8.1589 9.79908C9.99553 11.3296 10.9139 12.0949 12 12.0949C13.0861 12.0949 14.0045 11.3296 15.8411 9.79908L18 8"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                                <span class="whitespace-nowrap">{{ !empty($user->email) ? $user->email : '' }}</span>
                            </li>
                            <li class="flex items-center gap-2">

                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns=""
                                    class="w-5 h-5 shrink-0">
                                    <path
                                        d="M16.1007 13.359L16.5562 12.9062C17.1858 12.2801 18.1672 12.1515 18.9728 12.5894L20.8833 13.628C22.1102 14.2949 22.3806 15.9295 21.4217 16.883L20.0011 18.2954C19.6399 18.6546 19.1917 18.9171 18.6763 18.9651M4.00289 5.74561C3.96765 5.12559 4.25823 4.56668 4.69185 4.13552L6.26145 2.57483C7.13596 1.70529 8.61028 1.83992 9.37326 2.85908L10.6342 4.54348C11.2507 5.36691 11.1841 6.49484 10.4775 7.19738L10.1907 7.48257"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path opacity="0.5"
                                        d="M18.6763 18.9651C17.0469 19.117 13.0622 18.9492 8.8154 14.7266C4.81076 10.7447 4.09308 7.33182 4.00293 5.74561"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path opacity="0.5"
                                        d="M16.1007 13.3589C16.1007 13.3589 15.0181 14.4353 12.0631 11.4971C9.10807 8.55886 10.1907 7.48242 10.1907 7.48242"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                                <span class="whitespace-nowrap"
                                    dir="ltr">{{ !empty($user->phone) ? $user->phone : '' }}</span>
                            </li>
                            @if (isset($user->referral_code) && !is_null($user->referral_code))
                                <li class="flex items-center gap-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="">
                                        <path
                                            d="M17 7.82959L18.6965 9.35641C20.239 10.7447 21.0103 11.4389 21.0103 12.3296C21.0103 13.2203 20.239 13.9145 18.6965 15.3028L17 16.8296"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path d="M13.9868 5L12 12.4149L10.0132 19.8297" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" />
                                        <path
                                            d="M7.00005 7.82959L5.30358 9.35641C3.76102 10.7447 2.98975 11.4389 2.98975 12.3296C2.98975 13.2203 3.76102 13.9145 5.30358 15.3028L7.00005 16.8296"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                    <span
                                        class="whitespace-nowrap">{{ !empty($user->referral_code) ? $user->referral_code : '' }}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                {{-- <div class="panel lg:col-span-2 xl:col-span-3">
                    <div x-data="task">
                        <h5 class="md:absolute md:top-[25px] md:mb-0 mb-5 font-semibold text-lg dark:text-white-light">
                            Task
                        </h5>
                        <table id="taskTable" class="whitespace-nowrap">
                        </table>
                    </div>
                </div> --}}
                <div class="grid grid-cols-1 md:grid-cols-1 gap-5">
                    <div class="panel">
                        <div class="mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Total Wallet Balance</h5>
                        </div>
                        <div class="space-y-4">
                            <div class="border border-[#ebedf2] rounded dark:bg-[#1b2e4b] dark:border-0">
                                <div class="flex items-center justify-between p-4 py-2">
                                    <div
                                        class="grid place-content-center w-9 h-9 rounded-md bg-secondary-light dark:bg-secondary text-secondary dark:text-secondary-light">

                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="" class="w-5 h-5 shrink-0">
                                            <path
                                                d="M3.79424 12.0291C4.33141 9.34329 4.59999 8.00036 5.48746 7.13543C5.65149 6.97557 5.82894 6.8301 6.01786 6.70061C7.04004 6 8.40956 6 11.1486 6H12.8515C15.5906 6 16.9601 6 17.9823 6.70061C18.1712 6.8301 18.3486 6.97557 18.5127 7.13543C19.4001 8.00036 19.6687 9.34329 20.2059 12.0291C20.9771 15.8851 21.3627 17.8131 20.475 19.1793C20.3143 19.4267 20.1267 19.6555 19.9157 19.8616C18.7501 21 16.7839 21 12.8515 21H11.1486C7.21622 21 5.25004 21 4.08447 19.8616C3.87342 19.6555 3.68582 19.4267 3.5251 19.1793C2.63744 17.8131 3.02304 15.8851 3.79424 12.0291Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path opacity="0.5"
                                                d="M9 6V5C9 3.34315 10.3431 2 12 2C13.6569 2 15 3.34315 15 5V6"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                            <path opacity="0.5"
                                                d="M9.1709 15C9.58273 16.1652 10.694 17 12.0002 17C13.3064 17 14.4177 16.1652 14.8295 15"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                    </div>
                                    <div
                                        class="ltr:ml-4 rtl:mr-4 flex items-start justify-between flex-auto font-semibold">
                                        {{-- <h6 class="text-white-dark text-[13px] dark:text-white-dark">My Wallet Balance --}}
                                        {{-- <span class="block text-base text-[#515365] dark:text-white-light">$92,600</span> --}}
                                        {{-- </h6> --}}
                                        <p class="ltr:ml-auto rtl:mr-auto text-secondary">${{$totalBalance}}</p>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="border border-[#ebedf2] rounded dark:bg-[#1b2e4b] dark:border-0">
                                <div class="flex items-center justify-between p-4 py-2">
                                    <div
                                        class="grid place-content-center w-9 h-9 rounded-md bg-warning-light dark:bg-warning text-warning dark:text-warning-light">
    
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0">
                                            <path
                                                d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path opacity="0.5" d="M10 16H6" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path opacity="0.5" d="M14 16H12.5" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" />
                                            <path opacity="0.5" d="M2 10L22 10" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                    </div>
                                    <div
                                        class="ltr:ml-4 rtl:mr-4 flex items-start justify-between flex-auto font-semibold">
                                        <h6 class="text-white-dark text-[13px] dark:text-white-dark">Expenses <span
                                                class="block text-base text-[#515365] dark:text-white-light">$55,085</span>
                                        </h6>
                                        <p class="ltr:ml-auto rtl:mr-auto text-warning">80%</p>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="panel">
                        <div class="mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Total Earning Balance</h5>
                        </div>
                        <div class="space-y-4">
                            <div class="border border-[#ebedf2] rounded dark:bg-[#1b2e4b] dark:border-0">
                                <div class="flex items-center justify-between p-4 py-2">
                                    <div
                                        class="grid place-content-center w-9 h-9 rounded-md bg-secondary-light dark:bg-secondary text-secondary dark:text-secondary-light">

                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="" class="w-5 h-5 shrink-0">
                                            <path
                                                d="M3.79424 12.0291C4.33141 9.34329 4.59999 8.00036 5.48746 7.13543C5.65149 6.97557 5.82894 6.8301 6.01786 6.70061C7.04004 6 8.40956 6 11.1486 6H12.8515C15.5906 6 16.9601 6 17.9823 6.70061C18.1712 6.8301 18.3486 6.97557 18.5127 7.13543C19.4001 8.00036 19.6687 9.34329 20.2059 12.0291C20.9771 15.8851 21.3627 17.8131 20.475 19.1793C20.3143 19.4267 20.1267 19.6555 19.9157 19.8616C18.7501 21 16.7839 21 12.8515 21H11.1486C7.21622 21 5.25004 21 4.08447 19.8616C3.87342 19.6555 3.68582 19.4267 3.5251 19.1793C2.63744 17.8131 3.02304 15.8851 3.79424 12.0291Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path opacity="0.5"
                                                d="M9 6V5C9 3.34315 10.3431 2 12 2C13.6569 2 15 3.34315 15 5V6"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                            <path opacity="0.5"
                                                d="M9.1709 15C9.58273 16.1652 10.694 17 12.0002 17C13.3064 17 14.4177 16.1652 14.8295 15"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                    </div>
                                    <div
                                        class="ltr:ml-4 rtl:mr-4 flex items-start justify-between flex-auto font-semibold">
                                        <p class="ltr:ml-auto rtl:mr-auto text-secondary">${{$total_earning_balance}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-1 gap-5">
                    <div class="panel">
                        <div class="mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">Total Referral Balance</h5>
                        </div>
                        <div class="space-y-4">
                            <div class="border border-[#ebedf2] rounded dark:bg-[#1b2e4b] dark:border-0">
                                <div class="flex items-center justify-between p-4 py-2">
                                    <div
                                        class="grid place-content-center w-9 h-9 rounded-md bg-secondary-light dark:bg-secondary text-secondary dark:text-secondary-light">

                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="" class="w-5 h-5 shrink-0">
                                            <path
                                                d="M3.79424 12.0291C4.33141 9.34329 4.59999 8.00036 5.48746 7.13543C5.65149 6.97557 5.82894 6.8301 6.01786 6.70061C7.04004 6 8.40956 6 11.1486 6H12.8515C15.5906 6 16.9601 6 17.9823 6.70061C18.1712 6.8301 18.3486 6.97557 18.5127 7.13543C19.4001 8.00036 19.6687 9.34329 20.2059 12.0291C20.9771 15.8851 21.3627 17.8131 20.475 19.1793C20.3143 19.4267 20.1267 19.6555 19.9157 19.8616C18.7501 21 16.7839 21 12.8515 21H11.1486C7.21622 21 5.25004 21 4.08447 19.8616C3.87342 19.6555 3.68582 19.4267 3.5251 19.1793C2.63744 17.8131 3.02304 15.8851 3.79424 12.0291Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path opacity="0.5"
                                                d="M9 6V5C9 3.34315 10.3431 2 12 2C13.6569 2 15 3.34315 15 5V6"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                            <path opacity="0.5"
                                                d="M9.1709 15C9.58273 16.1652 10.694 17 12.0002 17C13.3064 17 14.4177 16.1652 14.8295 15"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                    </div>
                                    <div
                                        class="ltr:ml-4 rtl:mr-4 flex items-start justify-between flex-auto font-semibold">
                                        <p class="ltr:ml-auto rtl:mr-auto text-secondary">${{$referral_balance}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="mb-5">
                            <h5 class="font-semibold text-lg dark:text-white-light">WithDraw Balance</h5>
                        </div>
                        <div class="space-y-4">
                            <div class="border border-[#ebedf2] rounded dark:bg-[#1b2e4b] dark:border-0">
                                <div class="flex items-center justify-between p-4 py-2">
                                    <div
                                        class="grid place-content-center w-9 h-9 rounded-md bg-secondary-light dark:bg-secondary text-secondary dark:text-secondary-light">

                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="" class="w-5 h-5 shrink-0">
                                            <path
                                                d="M3.79424 12.0291C4.33141 9.34329 4.59999 8.00036 5.48746 7.13543C5.65149 6.97557 5.82894 6.8301 6.01786 6.70061C7.04004 6 8.40956 6 11.1486 6H12.8515C15.5906 6 16.9601 6 17.9823 6.70061C18.1712 6.8301 18.3486 6.97557 18.5127 7.13543C19.4001 8.00036 19.6687 9.34329 20.2059 12.0291C20.9771 15.8851 21.3627 17.8131 20.475 19.1793C20.3143 19.4267 20.1267 19.6555 19.9157 19.8616C18.7501 21 16.7839 21 12.8515 21H11.1486C7.21622 21 5.25004 21 4.08447 19.8616C3.87342 19.6555 3.68582 19.4267 3.5251 19.1793C2.63744 17.8131 3.02304 15.8851 3.79424 12.0291Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path opacity="0.5"
                                                d="M9 6V5C9 3.34315 10.3431 2 12 2C13.6569 2 15 3.34315 15 5V6"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                            <path opacity="0.5"
                                                d="M9.1709 15C9.58273 16.1652 10.694 17 12.0002 17C13.3064 17 14.4177 16.1652 14.8295 15"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                    </div>
                                    <div
                                        class="ltr:ml-4 rtl:mr-4 flex items-start justify-between flex-auto font-semibold">
                                        <p class="ltr:ml-auto rtl:mr-auto text-secondary">${{$withdraw_balance}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="panel">
                    <div class="mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Total Wallet Balance</h5>
                    </div>
                    <div class="space-y-4">
                        <div class="border border-[#ebedf2] rounded dark:bg-[#1b2e4b] dark:border-0">
                            <div class="flex items-center justify-between p-4 py-2">
                                <div
                                    class="grid place-content-center w-9 h-9 rounded-md bg-secondary-light dark:bg-secondary text-secondary dark:text-secondary-light">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="" class="w-5 h-5 shrink-0">
                                        <path
                                            d="M3.79424 12.0291C4.33141 9.34329 4.59999 8.00036 5.48746 7.13543C5.65149 6.97557 5.82894 6.8301 6.01786 6.70061C7.04004 6 8.40956 6 11.1486 6H12.8515C15.5906 6 16.9601 6 17.9823 6.70061C18.1712 6.8301 18.3486 6.97557 18.5127 7.13543C19.4001 8.00036 19.6687 9.34329 20.2059 12.0291C20.9771 15.8851 21.3627 17.8131 20.475 19.1793C20.3143 19.4267 20.1267 19.6555 19.9157 19.8616C18.7501 21 16.7839 21 12.8515 21H11.1486C7.21622 21 5.25004 21 4.08447 19.8616C3.87342 19.6555 3.68582 19.4267 3.5251 19.1793C2.63744 17.8131 3.02304 15.8851 3.79424 12.0291Z"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <path opacity="0.5"
                                            d="M9 6V5C9 3.34315 10.3431 2 12 2C13.6569 2 15 3.34315 15 5V6"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path opacity="0.5"
                                            d="M9.1709 15C9.58273 16.1652 10.694 17 12.0002 17C13.3064 17 14.4177 16.1652 14.8295 15"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div class="ltr:ml-4 rtl:mr-4 flex items-start justify-between flex-auto font-semibold"> --}}
                                    {{-- <h6 class="text-white-dark text-[13px] dark:text-white-dark">My Wallet Balance --}}
                                    {{-- <span class="block text-base text-[#515365] dark:text-white-light">$92,600</span> --}}
                                    {{-- </h6> --}}
                                    {{-- <p class="ltr:ml-auto rtl:mr-auto text-secondary">$120</p>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="border border-[#ebedf2] rounded dark:bg-[#1b2e4b] dark:border-0">
                            <div class="flex items-center justify-between p-4 py-2">
                                <div
                                    class="grid place-content-center w-9 h-9 rounded-md bg-warning-light dark:bg-warning text-warning dark:text-warning-light">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0">
                                        <path
                                            d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12Z"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <path opacity="0.5" d="M10 16H6" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" />
                                        <path opacity="0.5" d="M14 16H12.5" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" />
                                        <path opacity="0.5" d="M2 10L22 10" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div
                                    class="ltr:ml-4 rtl:mr-4 flex items-start justify-between flex-auto font-semibold">
                                    <h6 class="text-white-dark text-[13px] dark:text-white-dark">Expenses <span
                                            class="block text-base text-[#515365] dark:text-white-light">$55,085</span>
                                    </h6>
                                    <p class="ltr:ml-auto rtl:mr-auto text-warning">80%</p>
                                </div>
                            </div>
                        </div> --}}
                    {{-- </div>
                </div> --}}
                {{-- <div class="panel">
                    <div class="mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Total Earning Balance</h5>
                    </div>
                    <div class="space-y-4">
                        <div class="border border-[#ebedf2] rounded dark:bg-[#1b2e4b] dark:border-0">
                            <div class="flex items-center justify-between p-4 py-2">
                                <div
                                    class="grid place-content-center w-9 h-9 rounded-md bg-secondary-light dark:bg-secondary text-secondary dark:text-secondary-light">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="" class="w-5 h-5 shrink-0">
                                        <path
                                            d="M3.79424 12.0291C4.33141 9.34329 4.59999 8.00036 5.48746 7.13543C5.65149 6.97557 5.82894 6.8301 6.01786 6.70061C7.04004 6 8.40956 6 11.1486 6H12.8515C15.5906 6 16.9601 6 17.9823 6.70061C18.1712 6.8301 18.3486 6.97557 18.5127 7.13543C19.4001 8.00036 19.6687 9.34329 20.2059 12.0291C20.9771 15.8851 21.3627 17.8131 20.475 19.1793C20.3143 19.4267 20.1267 19.6555 19.9157 19.8616C18.7501 21 16.7839 21 12.8515 21H11.1486C7.21622 21 5.25004 21 4.08447 19.8616C3.87342 19.6555 3.68582 19.4267 3.5251 19.1793C2.63744 17.8131 3.02304 15.8851 3.79424 12.0291Z"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <path opacity="0.5"
                                            d="M9 6V5C9 3.34315 10.3431 2 12 2C13.6569 2 15 3.34315 15 5V6"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path opacity="0.5"
                                            d="M9.1709 15C9.58273 16.1652 10.694 17 12.0002 17C13.3064 17 14.4177 16.1652 14.8295 15"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div
                                    class="ltr:ml-4 rtl:mr-4 flex items-start justify-between flex-auto font-semibold">
                                    <p class="ltr:ml-auto rtl:mr-auto text-secondary">$100</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="panel">
                    <div class="mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Total Referral Balance</h5>
                    </div>
                    <div class="space-y-4">
                        <div class="border border-[#ebedf2] rounded dark:bg-[#1b2e4b] dark:border-0">
                            <div class="flex items-center justify-between p-4 py-2">
                                <div
                                    class="grid place-content-center w-9 h-9 rounded-md bg-secondary-light dark:bg-secondary text-secondary dark:text-secondary-light">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="" class="w-5 h-5 shrink-0">
                                        <path
                                            d="M3.79424 12.0291C4.33141 9.34329 4.59999 8.00036 5.48746 7.13543C5.65149 6.97557 5.82894 6.8301 6.01786 6.70061C7.04004 6 8.40956 6 11.1486 6H12.8515C15.5906 6 16.9601 6 17.9823 6.70061C18.1712 6.8301 18.3486 6.97557 18.5127 7.13543C19.4001 8.00036 19.6687 9.34329 20.2059 12.0291C20.9771 15.8851 21.3627 17.8131 20.475 19.1793C20.3143 19.4267 20.1267 19.6555 19.9157 19.8616C18.7501 21 16.7839 21 12.8515 21H11.1486C7.21622 21 5.25004 21 4.08447 19.8616C3.87342 19.6555 3.68582 19.4267 3.5251 19.1793C2.63744 17.8131 3.02304 15.8851 3.79424 12.0291Z"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <path opacity="0.5"
                                            d="M9 6V5C9 3.34315 10.3431 2 12 2C13.6569 2 15 3.34315 15 5V6"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path opacity="0.5"
                                            d="M9.1709 15C9.58273 16.1652 10.694 17 12.0002 17C13.3064 17 14.4177 16.1652 14.8295 15"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div
                                    class="ltr:ml-4 rtl:mr-4 flex items-start justify-between flex-auto font-semibold">
                                    <p class="ltr:ml-auto rtl:mr-auto text-secondary">$50</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="panel">
                    <div class="mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">WithDraw Balance</h5>
                    </div>
                    <div class="space-y-4">
                        <div class="border border-[#ebedf2] rounded dark:bg-[#1b2e4b] dark:border-0">
                            <div class="flex items-center justify-between p-4 py-2">
                                <div
                                    class="grid place-content-center w-9 h-9 rounded-md bg-secondary-light dark:bg-secondary text-secondary dark:text-secondary-light">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="" class="w-5 h-5 shrink-0">
                                        <path
                                            d="M3.79424 12.0291C4.33141 9.34329 4.59999 8.00036 5.48746 7.13543C5.65149 6.97557 5.82894 6.8301 6.01786 6.70061C7.04004 6 8.40956 6 11.1486 6H12.8515C15.5906 6 16.9601 6 17.9823 6.70061C18.1712 6.8301 18.3486 6.97557 18.5127 7.13543C19.4001 8.00036 19.6687 9.34329 20.2059 12.0291C20.9771 15.8851 21.3627 17.8131 20.475 19.1793C20.3143 19.4267 20.1267 19.6555 19.9157 19.8616C18.7501 21 16.7839 21 12.8515 21H11.1486C7.21622 21 5.25004 21 4.08447 19.8616C3.87342 19.6555 3.68582 19.4267 3.5251 19.1793C2.63744 17.8131 3.02304 15.8851 3.79424 12.0291Z"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <path opacity="0.5"
                                            d="M9 6V5C9 3.34315 10.3431 2 12 2C13.6569 2 15 3.34315 15 5V6"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path opacity="0.5"
                                            d="M9.1709 15C9.58273 16.1652 10.694 17 12.0002 17C13.3064 17 14.4177 16.1652 14.8295 15"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <div
                                    class="ltr:ml-4 rtl:mr-4 flex items-start justify-between flex-auto font-semibold">
                                    <p class="ltr:ml-auto rtl:mr-auto text-secondary">$30</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            {{-- </div> --}}
            <div class="grid lg:grid-cols-1 grid-cols-1 gap-6">
                <div x-data="userEarningBalance">
                    <script src="{{ asset('/assets/js/simple-datatables.js') }}"></script>
                    <div class="panel px-0 border-[#e0e6ed] dark:border-[#1b2e4b]">
                        <div class="px-5">
                            <div class="md:absolute md:top-5 ltr:md:left-5 rtl:md:right-5">
                                <div class="flex items-center gap-2 mb-5">
                                 <h5 class="font-semibold text-lg dark:text-white-light">User Earning Balance</h5>
                                </div>
                            </div>
                        </div>
                        <div class="earning-balance-table">
                            <table id="earningBalanceTable" class="whitespace-nowrap"></table>
                        </div>
                    </div>
                </div>

                {{-- <div class="panel h-full w-full">
                    <div class="flex items-center justify-between mb-5">
                        <h5 class="font-semibold text-lg dark:text-white-light">Top Selling Product</h5>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr class="border-b-0">
                                    <th class="ltr:rounded-l-md rtl:rounded-r-md">Product</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Sold</th>
                                    <th class="ltr:rounded-r-md rtl:rounded-l-md">Source</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group">
                                    <td class="min-w-[150px] text-black dark:text-white">
                                        <div class="flex"><img
                                                class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover"
                                                src="/assets/images/product-headphones.jpg" alt="avatar" />
                                            <p class="whitespace-nowrap">Headphone <span
                                                    class="text-primary block text-xs">Digital</span></p>
                                        </div>
                                    </td>
                                    <td>$168.09</td>
                                    <td>$60.09</td>
                                    <td>170</td>
                                    <td>
                                        <a class="text-danger flex items-center" href="javascript:;">
                                            <svg class="w-3.5 h-3.5 rtl:rotate-180 ltr:mr-1 rtl:ml-1"
                                                viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.6644 5.47875L16.6367 9.00968C18.2053 10.404 18.9896 11.1012 18.9896 11.9993C18.9896 12.8975 18.2053 13.5946 16.6367 14.989L12.6644 18.5199C11.9484 19.1563 11.5903 19.4746 11.2952 19.342C11 19.2095 11 18.7305 11 17.7725V15.4279C7.4 15.4279 3.5 17.1422 2 19.9993C2 10.8565 7.33333 8.57075 11 8.57075V6.22616C11 5.26817 11 4.78917 11.2952 4.65662C11.5903 4.52407 11.9484 4.8423 12.6644 5.47875Z"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path opacity="0.5"
                                                    d="M15.5386 4.5L20.7548 9.34362C21.5489 10.081 22.0001 11.1158 22.0001 12.1994C22.0001 13.3418 21.4989 14.4266 20.629 15.1671L15.5386 19.5"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" />
                                            </svg>

                                            Direct
                                        </a>
                                    </td>
                                </tr>
                                <tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group">
                                    <td class="text-black dark:text-white">
                                        <div class="flex"><img
                                                class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover"
                                                src="/assets/images/product-shoes.jpg" alt="avatar" />
                                            <p class="whitespace-nowrap">Shoes <span
                                                    class="text-warning block text-xs">Faishon</span></p>
                                        </div>
                                    </td>
                                    <td>$126.04</td>
                                    <td>$47.09</td>
                                    <td>130</td>
                                    <td>
                                        <a class="text-success flex items-center" href="javascript:;">
                                            <svg class="w-3.5 h-3.5 rtl:rotate-180 ltr:mr-1 rtl:ml-1"
                                                viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.6644 5.47875L16.6367 9.00968C18.2053 10.404 18.9896 11.1012 18.9896 11.9993C18.9896 12.8975 18.2053 13.5946 16.6367 14.989L12.6644 18.5199C11.9484 19.1563 11.5903 19.4746 11.2952 19.342C11 19.2095 11 18.7305 11 17.7725V15.4279C7.4 15.4279 3.5 17.1422 2 19.9993C2 10.8565 7.33333 8.57075 11 8.57075V6.22616C11 5.26817 11 4.78917 11.2952 4.65662C11.5903 4.52407 11.9484 4.8423 12.6644 5.47875Z"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path opacity="0.5"
                                                    d="M15.5386 4.5L20.7548 9.34362C21.5489 10.081 22.0001 11.1158 22.0001 12.1994C22.0001 13.3418 21.4989 14.4266 20.629 15.1671L15.5386 19.5"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" />
                                            </svg>
                                            Google
                                        </a>
                                    </td>
                                </tr>
                                <tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group">
                                    <td class="text-black dark:text-white">
                                        <div class="flex"><img
                                                class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover"
                                                src="/assets/images/product-watch.jpg" alt="avatar" />
                                            <p class="whitespace-nowrap">Watch <span
                                                    class="text-danger block text-xs">Accessories</span></p>
                                        </div>
                                    </td>
                                    <td>$56.07</td>
                                    <td>$20.00</td>
                                    <td>66</td>
                                    <td>
                                        <a class="text-warning flex items-center" href="javascript:;">
                                            <svg class="w-3.5 h-3.5 rtl:rotate-180 ltr:mr-1 rtl:ml-1"
                                                viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.6644 5.47875L16.6367 9.00968C18.2053 10.404 18.9896 11.1012 18.9896 11.9993C18.9896 12.8975 18.2053 13.5946 16.6367 14.989L12.6644 18.5199C11.9484 19.1563 11.5903 19.4746 11.2952 19.342C11 19.2095 11 18.7305 11 17.7725V15.4279C7.4 15.4279 3.5 17.1422 2 19.9993C2 10.8565 7.33333 8.57075 11 8.57075V6.22616C11 5.26817 11 4.78917 11.2952 4.65662C11.5903 4.52407 11.9484 4.8423 12.6644 5.47875Z"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path opacity="0.5"
                                                    d="M15.5386 4.5L20.7548 9.34362C21.5489 10.081 22.0001 11.1158 22.0001 12.1994C22.0001 13.3418 21.4989 14.4266 20.629 15.1671L15.5386 19.5"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" />
                                            </svg>
                                            Ads
                                        </a>
                                    </td>
                                </tr>
                                <tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group">
                                    <td class="text-black dark:text-white">
                                        <div class="flex"><img
                                                class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover"
                                                src="/assets/images/product-laptop.jpg" alt="avatar" />
                                            <p class="whitespace-nowrap">Laptop <span
                                                    class="text-primary block text-xs">Digital</span></p>
                                        </div>
                                    </td>
                                    <td>$110.00</td>
                                    <td>$33.00</td>
                                    <td>35</td>
                                    <td>
                                        <a class="text-secondary flex items-center" href="javascript:;">
                                            <svg class="w-3.5 h-3.5 rtl:rotate-180 ltr:mr-1 rtl:ml-1"
                                                viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.6644 5.47875L16.6367 9.00968C18.2053 10.404 18.9896 11.1012 18.9896 11.9993C18.9896 12.8975 18.2053 13.5946 16.6367 14.989L12.6644 18.5199C11.9484 19.1563 11.5903 19.4746 11.2952 19.342C11 19.2095 11 18.7305 11 17.7725V15.4279C7.4 15.4279 3.5 17.1422 2 19.9993C2 10.8565 7.33333 8.57075 11 8.57075V6.22616C11 5.26817 11 4.78917 11.2952 4.65662C11.5903 4.52407 11.9484 4.8423 12.6644 5.47875Z"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path opacity="0.5"
                                                    d="M15.5386 4.5L20.7548 9.34362C21.5489 10.081 22.0001 11.1158 22.0001 12.1994C22.0001 13.3418 21.4989 14.4266 20.629 15.1671L15.5386 19.5"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" />
                                            </svg>
                                            Email
                                        </a>
                                    </td>
                                </tr>
                                <tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group">
                                    <td class="text-black dark:text-white">
                                        <div class="flex"><img
                                                class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover"
                                                src="/assets/images/product-camera.jpg" alt="avatar" />
                                            <p class="whitespace-nowrap">Camera <span
                                                    class="text-primary block text-xs">Digital</span></p>
                                        </div>
                                    </td>
                                    <td>$56.07</td>
                                    <td>$26.04</td>
                                    <td>30</td>
                                    <td>
                                        <a class="text-primary flex items-center" href="javascript:;">
                                            <svg class="w-3.5 h-3.5 rtl:rotate-180 ltr:mr-1 rtl:ml-1"
                                                viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.6644 5.47875L16.6367 9.00968C18.2053 10.404 18.9896 11.1012 18.9896 11.9993C18.9896 12.8975 18.2053 13.5946 16.6367 14.989L12.6644 18.5199C11.9484 19.1563 11.5903 19.4746 11.2952 19.342C11 19.2095 11 18.7305 11 17.7725V15.4279C7.4 15.4279 3.5 17.1422 2 19.9993C2 10.8565 7.33333 8.57075 11 8.57075V6.22616C11 5.26817 11 4.78917 11.2952 4.65662C11.5903 4.52407 11.9484 4.8423 12.6644 5.47875Z"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path opacity="0.5"
                                                    d="M15.5386 4.5L20.7548 9.34362C21.5489 10.081 22.0001 11.1158 22.0001 12.1994C22.0001 13.3418 21.4989 14.4266 20.629 15.1671L15.5386 19.5"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" />
                                            </svg>
                                            Referral
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("userEarningBalance", () => ({
                datatable1: null,
                init() {
                    this.datatable1 = new simpleDatatables.DataTable('#earningBalanceTable', {
                        data: {
                            headings: ['Transaction Type', 'Transaction Date', 'Credit Amount'],
                            data: [
                                @foreach ($user_earning_balance as $user_earning)
                                    ['{{$user_earning->transaction_type }}',
                                    '{{date('d M Y', strtotime($user_earning->transaction_date))}}',
                                    '{{$user_earning->credit_amount}}',
                                    ],
                                @endforeach
                            ]
                        },
                        searchable: true,
                        perPage: 10,
                        perPageSelect: [10, 20, 30, 50, 100],
                        columns: [{
                                select: 0,
                                render: (data, cell, row) => {
                                    return `<div class="flex items-center w-max"><a href="">${data}</a></div>`;
                                },
                                sort: "asc"
                            },
                            // {
                            //     select: 3,
                            //     render: (data, cell, row) => {
                            //         return this.formatDate(data);
                            //     },
                            // },
                            // {
                            //     select: 6,
                            //     render: (data, cell, row) => {
                            //         return '<span class="badge bg-' + this
                            //         .randomColor() + '">' + this.randomStatus() +
                            //             '</span>';
                            //     },
                            // },
                        ],
                        firstLast: true,
                        firstText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        lastText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        prevText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        nextText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        labels: {
                            perPage: "{select}"
                        },
                        layout: {
                            top: "{search}",
                            bottom: "{info}{select}{pager}",
                        },
                    });
                },

                // formatDate(date) {
                //     if (date) {
                //         const dt = new Date(date);
                //         const month = dt.getMonth() + 1 < 10 ? '0' + (dt.getMonth() + 1) : dt
                //         .getMonth() + 1;
                //         const day = dt.getDate() < 10 ? '0' + dt.getDate() : dt.getDate();
                //         return day + '/' + month + '/' + dt.getFullYear();
                //     }
                //     return '';
                // },

                // randomColor() {
                //     const color = ['primary', 'secondary', 'success', 'danger', 'warning', 'info'];
                //     const random = Math.floor(Math.random() * color.length);
                //     return color[random];
                // },

                // randomStatus() {
                //     const status = ['PAID', 'APPROVED', 'FAILED', 'CANCEL', 'SUCCESS', 'PENDING','COMPLETE'
                //     ];
                //     const random = Math.floor(Math.random() * status.length);
                //     return status[random];
                // }
            }));
        });
    </script>
</x-layout.default>
